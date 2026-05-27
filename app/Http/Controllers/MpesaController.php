<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Cart;

class MpesaController extends Controller
{
    /**
     * Get M-Pesa OAuth access token from Safaricom Daraja API.
     */
    private function getAccessToken(): string
    {
        $consumerKey    = config('mpesa.consumer_key');
        $consumerSecret = config('mpesa.consumer_secret');
        $baseUrl        = config('mpesa.base_url');

        $response = Http::withBasicAuth($consumerKey, $consumerSecret)
            ->withoutVerifying()
            ->get("{$baseUrl}/oauth/v1/generate?grant_type=client_credentials");

        if ($response->failed()) {
            Log::error('M-Pesa: Failed to get access token', ['response' => $response->body()]);
            throw new \Exception('Could not connect to M-Pesa. Please try again.');
        }

        return $response->json('access_token');
    }

    /**
     * Show the M-Pesa payment waiting/confirmation page.
     */
    public function payPage(\App\Models\Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // If already paid, go home
        if ($order->payment_status === 'paid') {
            session()->forget(['cart', 'coupon', 'mpesa_order_id', 'mpesa_phone']);
            request()->session()->flash('success', 'Payment confirmed! Thank you for your order.');
            return redirect()->route('home');
        }

        $phone = session('mpesa_phone', $order->mpesa_phone ?? auth()->user()->phone ?? '');

        return view('frontend.pages.mpesa-pay', compact('order', 'phone'));
    }

    /**
     * Initiate STK Push (Lipa Na M-Pesa Online).
     * Called via AJAX from the checkout page.
     */
    public function stkPush(Request $request)
    {
        $request->validate([
            'phone'    => ['required', 'regex:/^(07|01|2547|2541)\d{8}$|^\+2547\d{8}$/'],
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Ensure this order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $phone   = $this->formatPhone($request->phone);
        $amount  = (int) ceil($order->total_amount); // M-Pesa requires whole numbers
        $baseUrl = config('mpesa.base_url');

        $shortcode  = config('mpesa.shortcode');
        $passkey    = config('mpesa.passkey');
        $timestamp  = now()->format('YmdHis');
        $password   = base64_encode($shortcode . $passkey . $timestamp);

        try {
            $token = $this->getAccessToken();

            $response = Http::withToken($token)
                ->withoutVerifying()
                ->post("{$baseUrl}/mpesa/stkpush/v1/processrequest", [
                    'BusinessShortCode' => $shortcode,
                    'Password'          => $password,
                    'Timestamp'         => $timestamp,
                    'TransactionType'   => 'CustomerPayBillOnline',
                    'Amount'            => $amount,
                    'PartyA'            => $phone,
                    'PartyB'            => $shortcode,
                    'PhoneNumber'       => $phone,
                    'CallBackURL'       => config('mpesa.callback_url'),
                    'AccountReference'  => config('mpesa.account_reference'),
                    'TransactionDesc'   => config('mpesa.transaction_desc'),
                ]);

            $data = $response->json();

            if (isset($data['ResponseCode']) && $data['ResponseCode'] === '0') {
                // Save the CheckoutRequestID so we can match the callback later
                $order->update([
                    'mpesa_checkout_request_id' => $data['CheckoutRequestID'],
                    'mpesa_phone'               => $phone,
                    'payment_method'            => 'mpesa',
                    'payment_status'            => 'unpaid',
                ]);

                return response()->json([
                    'success'             => true,
                    'message'             => 'STK Push sent. Please check your phone and enter your M-Pesa PIN.',
                    'checkout_request_id' => $data['CheckoutRequestID'],
                ]);
            }

            Log::error('M-Pesa STK Push failed', ['response' => $data]);
            return response()->json([
                'success' => false,
                'message' => $data['errorMessage'] ?? $data['CustomerMessage'] ?? 'STK Push failed. Please try again.',
            ], 422);

        } catch (\Exception $e) {
            Log::error('M-Pesa STK Push exception', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Poll the STK Push query endpoint to check payment status.
     * Called via AJAX polling from the checkout page.
     */
    public function stkQuery(Request $request)
    {
        $request->validate([
            'checkout_request_id' => 'required|string',
            'order_id'            => 'required|integer|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->order_id);

        if ($order->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        // If already marked paid (callback arrived), return success immediately
        if ($order->payment_status === 'paid') {
            return response()->json(['success' => true, 'status' => 'paid']);
        }

        $baseUrl   = config('mpesa.base_url');
        $shortcode = config('mpesa.shortcode');
        $passkey   = config('mpesa.passkey');
        $timestamp = now()->format('YmdHis');
        $password  = base64_encode($shortcode . $passkey . $timestamp);

        try {
            $token = $this->getAccessToken();

            $response = Http::withToken($token)
                ->withoutVerifying()
                ->post("{$baseUrl}/mpesa/stkpushquery/v1/query", [
                    'BusinessShortCode' => $shortcode,
                    'Password'          => $password,
                    'Timestamp'         => $timestamp,
                    'CheckoutRequestID' => $request->checkout_request_id,
                ]);

            $data = $response->json();

            // ResultCode 0 = success
            if (isset($data['ResultCode'])) {
                if ($data['ResultCode'] === '0' || $data['ResultCode'] === 0) {
                    $order->update(['payment_status' => 'paid']);
                    $this->finalizeOrder($order);
                    return response()->json(['success' => true, 'status' => 'paid']);
                }

                // ResultCode 1032 = cancelled by user, 1037 = timeout
                return response()->json([
                    'success' => false,
                    'status'  => 'failed',
                    'message' => $data['ResultDesc'] ?? 'Payment was not completed.',
                ]);
            }

            // Still pending
            return response()->json(['success' => true, 'status' => 'pending']);

        } catch (\Exception $e) {
            Log::error('M-Pesa STK Query exception', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Receive the M-Pesa payment callback from Safaricom.
     */
    public function callback(Request $request)
    {
        Log::info('M-Pesa Callback received', ['payload' => $request->all()]);

        $data = $request->all();

        try {
            $body        = $data['Body']['stkCallback'] ?? null;
            $resultCode  = $body['ResultCode'] ?? null;
            $checkoutId  = $body['CheckoutRequestID'] ?? null;

            if (!$checkoutId) {
                return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
            }

            $order = Order::where('mpesa_checkout_request_id', $checkoutId)->first();

            if (!$order) {
                Log::warning('M-Pesa callback: order not found for CheckoutRequestID', ['id' => $checkoutId]);
                return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
            }

            if ($resultCode == 0) {
                // Payment successful — extract transaction ID from callback metadata
                $items = $body['CallbackMetadata']['Item'] ?? [];
                $transactionId = null;
                foreach ($items as $item) {
                    if ($item['Name'] === 'MpesaReceiptNumber') {
                        $transactionId = $item['Value'];
                        break;
                    }
                }

                $order->update([
                    'payment_status'       => 'paid',
                    'mpesa_transaction_id' => $transactionId,
                ]);

                $this->finalizeOrder($order);

            } else {
                Log::info('M-Pesa payment not completed', [
                    'order_id'    => $order->id,
                    'result_code' => $resultCode,
                    'result_desc' => $body['ResultDesc'] ?? '',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('M-Pesa callback processing error', ['error' => $e->getMessage()]);
        }

        // Always return 200 to Safaricom
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Accepted']);
    }

    /**
     * Finalize the order after successful payment:
     * link cart items, clear sessions.
     */
    private function finalizeOrder(Order $order): void
    {
        Cart::where('user_id', $order->user_id)
            ->where('order_id', null)
            ->update(['order_id' => $order->id]);
    }

    /**
     * Normalize phone number to 2547XXXXXXXX format.
     */
    private function formatPhone(string $phone): string
    {
        $phone = preg_replace('/\s+/', '', $phone);

        if (str_starts_with($phone, '+')) {
            $phone = ltrim($phone, '+');
        }

        if (str_starts_with($phone, '07') || str_starts_with($phone, '01')) {
            $phone = '254' . substr($phone, 1);
        }

        return $phone;
    }
}

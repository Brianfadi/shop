<?php

return [
    /*
    |--------------------------------------------------------------------------
    | M-Pesa Daraja API Configuration
    |--------------------------------------------------------------------------
    |
    | Safaricom Daraja API credentials for Lipa Na M-Pesa Online (STK Push).
    | Set MPESA_ENV=sandbox for testing, MPESA_ENV=production for live.
    |
    */

    'env' => env('MPESA_ENV', 'sandbox'),

    'base_url' => env('MPESA_ENV', 'sandbox') === 'production'
        ? 'https://api.safaricom.co.ke'
        : 'https://sandbox.safaricom.co.ke',

    'consumer_key'    => env('MPESA_CONSUMER_KEY', ''),
    'consumer_secret' => env('MPESA_CONSUMER_SECRET', ''),

    /*
    | For sandbox testing use shortcode 174379 and the sandbox passkey below.
    | For production, use your actual Paybill/Till number and passkey from Daraja portal.
    */
    'shortcode' => env('MPESA_SHORTCODE', '174379'),
    'passkey'   => env('MPESA_PASSKEY', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'),

    /*
    | The URL Safaricom will POST the payment result to.
    | Must be a publicly accessible HTTPS URL (use ngrok for local testing).
    */
    'callback_url' => env('MPESA_CALLBACK_URL', 'https://yourdomain.com/mpesa/callback'),

    'account_reference' => env('MPESA_ACCOUNT_REFERENCE', 'AdvanceEcommerce'),
    'transaction_desc'  => env('MPESA_TRANSACTION_DESC', 'Payment for order'),
];

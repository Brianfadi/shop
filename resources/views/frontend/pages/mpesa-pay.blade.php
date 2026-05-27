@extends('frontend.layouts.master')

@section('title', 'Complete M-Pesa Payment')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li><a href="{{ route('checkout') }}">Checkout<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0)">M-Pesa Payment</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<section class="shop checkout section" style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">

                <div class="card shadow-sm" style="border-radius:12px; overflow:hidden;">
                    <!-- Green M-Pesa header -->
                    <div style="background:#4CAF50; padding:24px; text-align:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60" style="height:50px;">
                            <rect width="200" height="60" rx="6" fill="#4CAF50"/>
                            <text x="100" y="22" font-family="Arial,sans-serif" font-size="11" font-weight="bold"
                                  fill="#fff" text-anchor="middle" letter-spacing="2">M-PESA</text>
                            <text x="100" y="42" font-family="Arial,sans-serif" font-size="9"
                                  fill="#c8e6c9" text-anchor="middle">LIPA NA M-PESA</text>
                        </svg>
                        <h4 style="color:#fff; margin-top:12px; margin-bottom:0;">Lipa Na M-Pesa</h4>
                    </div>

                    <div class="card-body" style="padding:30px;">

                        <!-- Order summary -->
                        <div style="background:#f9f9f9; border-radius:8px; padding:16px; margin-bottom:24px;">
                            <div class="d-flex justify-content-between">
                                <span style="color:#666;">Order Number</span>
                                <strong>{{ $order->order_number }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span style="color:#666;">Amount to Pay</span>
                                <strong style="color:#4CAF50; font-size:1.2em;">
                                    KSh {{ number_format($order->total_amount, 2) }}
                                </strong>
                            </div>
                        </div>

                        <!-- Step 1: Enter phone -->
                        <div id="step-phone">
                            <h5 style="margin-bottom:16px;">Enter your M-Pesa phone number</h5>
                            <div class="form-group">
                                <label for="phone_input" style="font-weight:600;">
                                    Safaricom Phone Number <span style="color:red">*</span>
                                </label>
                                <div style="display:flex; gap:8px; margin-top:6px;">
                                    <input type="tel"
                                           id="phone_input"
                                           class="form-control"
                                           placeholder="e.g. 0712345678"
                                           value="{{ $phone }}"
                                           style="flex:1; padding:10px; border:1px solid #ddd; border-radius:6px; font-size:1em;">
                                    <button id="btn-send-stk"
                                            class="btn"
                                            style="background:#4CAF50; color:#fff; padding:10px 20px; border-radius:6px; white-space:nowrap;">
                                        Send Prompt
                                    </button>
                                </div>
                                <small style="color:#888; display:block; margin-top:6px;">
                                    A payment prompt will be sent to this number. Enter your M-Pesa PIN to complete.
                                </small>
                                <div id="phone-error" style="color:red; margin-top:6px; display:none;"></div>
                            </div>
                        </div>

                        <!-- Step 2: Waiting for payment -->
                        <div id="step-waiting" style="display:none; text-align:center; padding:20px 0;">
                            <div id="spinner" style="margin-bottom:16px;">
                                <svg width="50" height="50" viewBox="0 0 50 50" style="animation:spin 1s linear infinite;">
                                    <circle cx="25" cy="25" r="20" fill="none" stroke="#4CAF50" stroke-width="4"
                                            stroke-dasharray="80 20" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h5 style="color:#333;">Waiting for payment confirmation...</h5>
                            <p style="color:#666; margin-top:8px;">
                                Check your phone <strong id="display-phone"></strong> and enter your M-Pesa PIN.
                            </p>
                            <p style="color:#999; font-size:0.85em;">This page will update automatically.</p>
                            <button id="btn-resend"
                                    class="btn btn-sm"
                                    style="margin-top:12px; background:#fff; border:1px solid #4CAF50; color:#4CAF50; border-radius:6px; padding:6px 16px;">
                                Resend Prompt
                            </button>
                            <button id="btn-change-phone"
                                    class="btn btn-sm"
                                    style="margin-top:12px; margin-left:8px; background:#fff; border:1px solid #999; color:#666; border-radius:6px; padding:6px 16px;">
                                Change Number
                            </button>
                        </div>

                        <!-- Step 3: Success -->
                        <div id="step-success" style="display:none; text-align:center; padding:20px 0;">
                            <div style="font-size:3em; color:#4CAF50; margin-bottom:12px;">✓</div>
                            <h4 style="color:#4CAF50;">Payment Successful!</h4>
                            <p style="color:#666; margin-top:8px;">
                                Your order <strong>{{ $order->order_number }}</strong> has been confirmed.
                            </p>
                            <a href="{{ route('home') }}" class="btn" style="margin-top:16px; background:#4CAF50; color:#fff; border-radius:6px; padding:10px 28px;">
                                Continue Shopping
                            </a>
                        </div>

                        <!-- Step 4: Failed -->
                        <div id="step-failed" style="display:none; text-align:center; padding:20px 0;">
                            <div style="font-size:3em; color:#e74c3c; margin-bottom:12px;">✗</div>
                            <h4 style="color:#e74c3c;">Payment Failed</h4>
                            <p id="fail-message" style="color:#666; margin-top:8px;"></p>
                            <button id="btn-retry"
                                    class="btn"
                                    style="margin-top:16px; background:#4CAF50; color:#fff; border-radius:6px; padding:10px 28px;">
                                Try Again
                            </button>
                        </div>

                    </div><!-- /.card-body -->
                </div><!-- /.card -->

                <div style="text-align:center; margin-top:20px;">
                    <a href="{{ route('checkout') }}" style="color:#999; font-size:0.9em;">
                        ← Back to Checkout
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .d-flex { display: flex; }
    .justify-content-between { justify-content: space-between; }
    .mt-2 { margin-top: 8px; }
    .card { background: #fff; border: 1px solid #e0e0e0; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const orderId            = {{ $order->id }};
    const stkPushUrl         = "{{ route('mpesa.stk-push') }}";
    const stkQueryUrl        = "{{ route('mpesa.stk-query') }}";
    const csrfToken          = "{{ csrf_token() }}";

    let checkoutRequestId    = null;
    let pollingInterval      = null;
    let pollCount            = 0;
    const MAX_POLLS          = 24; // ~2 minutes at 5s intervals

    // ── UI helpers ──────────────────────────────────────────────────────────
    function showStep(step) {
        ['step-phone', 'step-waiting', 'step-success', 'step-failed'].forEach(function (id) {
            document.getElementById(id).style.display = (id === step) ? 'block' : 'none';
        });
    }

    function setButtonLoading(btn, loading) {
        btn.disabled = loading;
        btn.textContent = loading ? 'Sending...' : 'Send Prompt';
    }

    // ── Send STK Push ────────────────────────────────────────────────────────
    function sendStkPush(phone) {
        const btn = document.getElementById('btn-send-stk');
        const errEl = document.getElementById('phone-error');
        errEl.style.display = 'none';

        // Basic client-side validation
        if (!/^(07|01)\d{8}$/.test(phone.trim())) {
            errEl.textContent = 'Please enter a valid Safaricom number (e.g. 0712345678).';
            errEl.style.display = 'block';
            return;
        }

        setButtonLoading(btn, true);

        fetch(stkPushUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ phone: phone.trim(), order_id: orderId }),
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            setButtonLoading(btn, false);
            if (data.success) {
                checkoutRequestId = data.checkout_request_id;
                document.getElementById('display-phone').textContent = phone.trim();
                showStep('step-waiting');
                startPolling();
            } else {
                errEl.textContent = data.message || 'Failed to send prompt. Please try again.';
                errEl.style.display = 'block';
            }
        })
        .catch(function () {
            setButtonLoading(btn, false);
            errEl.textContent = 'Network error. Please check your connection and try again.';
            errEl.style.display = 'block';
        });
    }

    // ── Poll for payment status ──────────────────────────────────────────────
    function startPolling() {
        pollCount = 0;
        clearInterval(pollingInterval);
        pollingInterval = setInterval(pollStatus, 5000);
    }

    function stopPolling() {
        clearInterval(pollingInterval);
        pollingInterval = null;
    }

    function pollStatus() {
        pollCount++;

        if (pollCount > MAX_POLLS) {
            stopPolling();
            document.getElementById('fail-message').textContent =
                'Payment timed out. Please try again.';
            showStep('step-failed');
            return;
        }

        fetch(stkQueryUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                checkout_request_id: checkoutRequestId,
                order_id: orderId,
            }),
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.status === 'paid') {
                stopPolling();
                showStep('step-success');
                // Clear cart/coupon sessions via a silent redirect after 3s
                setTimeout(function () {
                    window.location.href = "{{ route('home') }}";
                }, 3000);
            } else if (data.status === 'failed') {
                stopPolling();
                document.getElementById('fail-message').textContent =
                    data.message || 'Payment was not completed.';
                showStep('step-failed');
            }
            // 'pending' → keep polling
        })
        .catch(function () {
            // Network hiccup — keep polling silently
        });
    }

    // ── Event listeners ──────────────────────────────────────────────────────
    document.getElementById('btn-send-stk').addEventListener('click', function () {
        sendStkPush(document.getElementById('phone_input').value);
    });

    document.getElementById('phone_input').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendStkPush(this.value);
        }
    });

    document.getElementById('btn-resend').addEventListener('click', function () {
        stopPolling();
        sendStkPush(document.getElementById('phone_input').value);
    });

    document.getElementById('btn-change-phone').addEventListener('click', function () {
        stopPolling();
        showStep('step-phone');
    });

    document.getElementById('btn-retry').addEventListener('click', function () {
        showStep('step-phone');
    });

    // Auto-send if phone was pre-filled from checkout form
    (function () {
        const preFilledPhone = document.getElementById('phone_input').value.trim();
        if (preFilledPhone && /^(07|01)\d{8}$/.test(preFilledPhone)) {
            sendStkPush(preFilledPhone);
        }
    })();

})();
</script>
@endpush

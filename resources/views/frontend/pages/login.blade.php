@extends('frontend.layouts.master')

@section('title','Sign In | Ecommerce Laravel')

@section('main-content')

@php $settings = DB::table('settings')->get(); @endphp

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- ===== LOGIN SECTION ===== -->
<section class="login-section">
    <div class="login-wrapper">

        <!-- LEFT PANEL -->
        <div class="login-left-panel">
            <div class="login-left-inner">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="login-logo">
                    <img src="@foreach($settings as $data){{ $data->logo }}@endforeach" alt="Logo">
                </a>

                <h2 class="login-brand-title">Welcome Back!</h2>
                <p class="login-brand-sub">Sign in to access your orders, wishlist, and exclusive deals tailored just for you.</p>

                <!-- Feature list -->
                <ul class="login-features">
                    <li><span class="lf-icon"><i class="ti-rocket"></i></span> Fast delivery across Kenya</li>
                    <li><span class="lf-icon"><i class="ti-lock"></i></span> Secure M-Pesa &amp; card payments</li>
                    <li><span class="lf-icon"><i class="ti-reload"></i></span> Easy 30-day returns</li>
                    <li><span class="lf-icon"><i class="ti-tag"></i></span> Exclusive member discounts</li>
                </ul>

                <!-- Decorative circles -->
                <div class="lp-circle lp-circle-1"></div>
                <div class="lp-circle lp-circle-2"></div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="login-right-panel">
            <div class="login-form-box">

                <div class="login-form-header">
                    <h3>Sign In</h3>
                    <p>Don't have an account? <a href="{{ route('register.form') }}">Create one free</a></p>
                </div>

                {{-- Session errors --}}
                @if(session('error'))
                    <div class="login-alert login-alert-error">
                        <i class="ti-close"></i> {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="login-alert login-alert-success">
                        <i class="ti-check"></i> {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <!-- Email -->
                    <div class="lf-group">
                        <label for="login-email">
                            <i class="ti-email"></i> Email Address
                        </label>
                        <input
                            type="email"
                            id="login-email"
                            name="email"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'lf-input-error' : '' }}"
                        >
                        @error('email')
                            <span class="lf-error-msg"><i class="ti-alert"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="lf-group">
                        <label for="login-password">
                            <i class="ti-lock"></i> Password
                        </label>
                        <div class="lf-password-wrap">
                            <input
                                type="password"
                                id="login-password"
                                name="password"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                                class="{{ $errors->has('password') ? 'lf-input-error' : '' }}"
                            >
                            <button type="button" class="lf-toggle-pw" onclick="togglePassword()" title="Show/hide password">
                                <i class="ti-eye" id="pw-eye-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="lf-error-msg"><i class="ti-alert"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="lf-row-between">
                        <label class="lf-remember">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="lf-forgot">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="lf-submit-btn">
                        <i class="ti-unlock"></i> Sign In
                    </button>

                </form>

                <div class="lf-divider"><span>or</span></div>

                <a href="{{ route('register.form') }}" class="lf-register-btn">
                    <i class="ti-user"></i> Create a New Account
                </a>

            </div>
        </div>

    </div>
</section>
<!-- ===== END LOGIN ===== -->

@endsection

@push('styles')
<style>
/* ── Layout ── */
.login-section {
    background: #f4f6fb;
    min-height: calc(100vh - 160px);
    display: flex;
    align-items: stretch;
}
.login-wrapper {
    display: flex;
    width: 100%;
    min-height: 600px;
    max-width: 1100px;
    margin: 60px auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 80px rgba(0,0,0,0.12);
}

/* ── Left Panel ── */
.login-left-panel {
    flex: 1;
    background: linear-gradient(145deg, #1a1a2e 0%, #0f3460 60%, #ff6b35 150%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
}
.login-left-inner {
    position: relative;
    z-index: 2;
}
.login-logo img {
    height: 48px;
    margin-bottom: 40px;
    display: block;
    filter: brightness(0) invert(1);
}
.login-brand-title {
    color: #fff;
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 14px;
    line-height: 1.2;
}
.login-brand-sub {
    color: rgba(255,255,255,0.72);
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 36px;
}
.login-features {
    list-style: none;
    padding: 0;
    margin: 0;
}
.login-features li {
    color: rgba(255,255,255,0.85);
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}
.lf-icon {
    width: 34px;
    height: 34px;
    background: rgba(255,255,255,0.12);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 15px;
    color: #ff6b35;
}
/* decorative circles */
.lp-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}
.lp-circle-1 { width: 320px; height: 320px; bottom: -100px; right: -100px; }
.lp-circle-2 { width: 180px; height: 180px; top: -60px; left: -60px; }

/* ── Right Panel ── */
.login-right-panel {
    flex: 1;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
}
.login-form-box {
    width: 100%;
    max-width: 400px;
}
.login-form-header {
    margin-bottom: 32px;
}
.login-form-header h3 {
    font-size: 28px;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 8px;
}
.login-form-header p {
    color: #888;
    font-size: 14px;
}
.login-form-header a {
    color: #ff6b35;
    font-weight: 600;
    text-decoration: none;
}
.login-form-header a:hover { text-decoration: underline; }

/* Alerts */
.login-alert {
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.login-alert-error  { background: #fff0f0; color: #c0392b; border: 1px solid #f5c6cb; }
.login-alert-success{ background: #f0fff4; color: #27ae60; border: 1px solid #c3e6cb; }

/* Form groups */
.lf-group {
    margin-bottom: 22px;
}
.lf-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
}
.lf-group label i {
    color: #ff6b35;
    margin-right: 5px;
}
.lf-group input {
    width: 100%;
    padding: 13px 16px;
    border: 1.5px solid #e8e8e8;
    border-radius: 8px;
    font-size: 14px;
    color: #333;
    background: #fafafa;
    transition: border-color .25s, box-shadow .25s;
    outline: none;
    box-sizing: border-box;
}
.lf-group input:focus {
    border-color: #ff6b35;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(255,107,53,0.12);
}
.lf-input-error { border-color: #e74c3c !important; }
.lf-error-msg {
    display: block;
    color: #e74c3c;
    font-size: 12px;
    margin-top: 6px;
}

/* Password toggle */
.lf-password-wrap {
    position: relative;
}
.lf-password-wrap input {
    padding-right: 46px;
}
.lf-toggle-pw {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #aaa;
    font-size: 16px;
    padding: 0;
    line-height: 1;
}
.lf-toggle-pw:hover { color: #ff6b35; }

/* Remember + Forgot row */
.lf-row-between {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
}
.lf-remember {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    color: #555;
    cursor: pointer;
    font-weight: 500;
}
.lf-remember input[type="checkbox"] {
    width: 15px;
    height: 15px;
    accent-color: #ff6b35;
    cursor: pointer;
}
.lf-forgot {
    font-size: 13px;
    color: #ff6b35;
    font-weight: 600;
    text-decoration: none;
}
.lf-forgot:hover { text-decoration: underline; }

/* Submit button */
.lf-submit-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #ff6b35, #f7931e);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 0.5px;
    transition: opacity .25s, transform .2s, box-shadow .25s;
    box-shadow: 0 6px 20px rgba(255,107,53,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.lf-submit-btn:hover {
    opacity: 0.92;
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(255,107,53,0.45);
}

/* Divider */
.lf-divider {
    text-align: center;
    margin: 24px 0;
    position: relative;
}
.lf-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #eee;
}
.lf-divider span {
    position: relative;
    background: #fff;
    padding: 0 14px;
    color: #aaa;
    font-size: 13px;
}

/* Register button */
.lf-register-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px;
    background: #fff;
    color: #1a1a2e;
    border: 1.5px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: border-color .25s, background .25s;
}
.lf-register-btn:hover {
    border-color: #1a1a2e;
    background: #f8f9fa;
    color: #1a1a2e;
    text-decoration: none;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .login-wrapper {
        flex-direction: column;
        margin: 20px 16px;
        border-radius: 12px;
    }
    .login-left-panel {
        padding: 40px 30px;
    }
    .login-brand-title { font-size: 24px; }
    .login-right-panel {
        padding: 40px 30px;
    }
}
@media (max-width: 480px) {
    .login-right-panel { padding: 30px 20px; }
    .login-left-panel  { padding: 30px 20px; }
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    var input = document.getElementById('login-password');
    var icon  = document.getElementById('pw-eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'ti-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'ti-eye';
    }
}
</script>
@endpush

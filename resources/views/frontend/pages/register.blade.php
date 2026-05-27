@extends('frontend.layouts.master')

@section('title','Create Account | Ecommerce Laravel')

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
                        <li class="active"><a href="javascript:void(0);">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- ===== REGISTER SECTION ===== -->
<section class="reg-section">
    <div class="reg-wrapper">

        <!-- LEFT PANEL — Form -->
        <div class="reg-form-panel">
            <div class="reg-form-box">

                <div class="reg-form-header">
                    <h3>Create an Account</h3>
                    <p>Already have an account? <a href="{{ route('login.form') }}">Sign in here</a></p>
                </div>

                {{-- Alerts --}}
                @if(session('error'))
                    <div class="reg-alert reg-alert-error"><i class="ti-close"></i> {{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="reg-alert reg-alert-success"><i class="ti-check"></i> {{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <!-- Name -->
                    <div class="rf-group">
                        <label for="reg-name"><i class="ti-user"></i> Full Name</label>
                        <input
                            type="text"
                            id="reg-name"
                            name="name"
                            placeholder="John Doe"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            class="{{ $errors->has('name') ? 'rf-input-error' : '' }}"
                        >
                        @error('name')
                            <span class="rf-error-msg"><i class="ti-alert"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="rf-group">
                        <label for="reg-email"><i class="ti-email"></i> Email Address</label>
                        <input
                            type="email"
                            id="reg-email"
                            name="email"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            class="{{ $errors->has('email') ? 'rf-input-error' : '' }}"
                        >
                        @error('email')
                            <span class="rf-error-msg"><i class="ti-alert"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password row -->
                    <div class="rf-row-two">
                        <!-- Password -->
                        <div class="rf-group">
                            <label for="reg-password"><i class="ti-lock"></i> Password</label>
                            <div class="rf-password-wrap">
                                <input
                                    type="password"
                                    id="reg-password"
                                    name="password"
                                    placeholder="Min. 8 characters"
                                    required
                                    autocomplete="new-password"
                                    class="{{ $errors->has('password') ? 'rf-input-error' : '' }}"
                                >
                                <button type="button" class="rf-toggle-pw" onclick="togglePw('reg-password','pw-icon-1')" title="Show/hide">
                                    <i class="ti-eye" id="pw-icon-1"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="rf-error-msg"><i class="ti-alert"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="rf-group">
                            <label for="reg-confirm"><i class="ti-lock"></i> Confirm Password</label>
                            <div class="rf-password-wrap">
                                <input
                                    type="password"
                                    id="reg-confirm"
                                    name="password_confirmation"
                                    placeholder="Repeat password"
                                    required
                                    autocomplete="new-password"
                                    class="{{ $errors->has('password_confirmation') ? 'rf-input-error' : '' }}"
                                >
                                <button type="button" class="rf-toggle-pw" onclick="togglePw('reg-confirm','pw-icon-2')" title="Show/hide">
                                    <i class="ti-eye" id="pw-icon-2"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <span class="rf-error-msg"><i class="ti-alert"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password strength bar -->
                    <div class="rf-strength-wrap">
                        <div class="rf-strength-bar" id="strength-bar"></div>
                    </div>
                    <p class="rf-strength-label" id="strength-label"></p>

                    <!-- Terms -->
                    <label class="rf-terms">
                        <input type="checkbox" required> I agree to the
                        <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>

                    <!-- Submit -->
                    <button type="submit" class="rf-submit-btn">
                        <i class="ti-user"></i> Create My Account
                    </button>

                </form>

                <div class="rf-divider"><span>or</span></div>

                <a href="{{ route('login.form') }}" class="rf-login-btn">
                    <i class="ti-unlock"></i> Sign In Instead
                </a>

            </div>
        </div>

        <!-- RIGHT PANEL — Branding -->
        <div class="reg-brand-panel">
            <div class="reg-brand-inner">
                <a href="{{ route('home') }}" class="reg-logo">
                    <img src="@foreach($settings as $data){{ $data->logo }}@endforeach" alt="Logo">
                </a>

                <h2 class="reg-brand-title">Join Thousands of Happy Shoppers</h2>
                <p class="reg-brand-sub">Create your free account today and unlock a world of quality products delivered right to your door across Kenya.</p>

                <!-- Perks -->
                <div class="reg-perks">
                    <div class="reg-perk">
                        <div class="reg-perk-icon"><i class="ti-gift"></i></div>
                        <div>
                            <strong>Welcome Offer</strong>
                            <span>Get a discount on your first order after signing up.</span>
                        </div>
                    </div>
                    <div class="reg-perk">
                        <div class="reg-perk-icon"><i class="ti-heart"></i></div>
                        <div>
                            <strong>Save Your Wishlist</strong>
                            <span>Bookmark products and come back to them anytime.</span>
                        </div>
                    </div>
                    <div class="reg-perk">
                        <div class="reg-perk-icon"><i class="ti-package"></i></div>
                        <div>
                            <strong>Track Your Orders</strong>
                            <span>Real-time updates on every order from checkout to delivery.</span>
                        </div>
                    </div>
                    <div class="reg-perk">
                        <div class="reg-perk-icon"><i class="ti-tag"></i></div>
                        <div>
                            <strong>Exclusive Deals</strong>
                            <span>Members-only prices and early access to sales.</span>
                        </div>
                    </div>
                </div>

                <!-- Decorative circles -->
                <div class="rp-circle rp-circle-1"></div>
                <div class="rp-circle rp-circle-2"></div>
            </div>
        </div>

    </div>
</section>
<!-- ===== END REGISTER ===== -->

@endsection

@push('styles')
<style>
/* ── Layout ── */
.reg-section {
    background: #f4f6fb;
    min-height: calc(100vh - 160px);
    display: flex;
    align-items: stretch;
}
.reg-wrapper {
    display: flex;
    width: 100%;
    min-height: 640px;
    max-width: 1100px;
    margin: 60px auto;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 80px rgba(0,0,0,0.12);
}

/* ── Form Panel (left) ── */
.reg-form-panel {
    flex: 1;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
}
.reg-form-box {
    width: 100%;
    max-width: 420px;
}
.reg-form-header {
    margin-bottom: 28px;
}
.reg-form-header h3 {
    font-size: 28px;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 8px;
}
.reg-form-header p { color: #888; font-size: 14px; }
.reg-form-header a { color: #ff6b35; font-weight: 600; text-decoration: none; }
.reg-form-header a:hover { text-decoration: underline; }

/* Alerts */
.reg-alert {
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.reg-alert-error   { background: #fff0f0; color: #c0392b; border: 1px solid #f5c6cb; }
.reg-alert-success { background: #f0fff4; color: #27ae60; border: 1px solid #c3e6cb; }

/* Form groups */
.rf-group {
    margin-bottom: 18px;
}
.rf-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 7px;
}
.rf-group label i { color: #ff6b35; margin-right: 5px; }
.rf-group input {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e8e8e8;
    border-radius: 8px;
    font-size: 14px;
    color: #333;
    background: #fafafa;
    transition: border-color .25s, box-shadow .25s;
    outline: none;
    box-sizing: border-box;
}
.rf-group input:focus {
    border-color: #ff6b35;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(255,107,53,0.12);
}
.rf-input-error { border-color: #e74c3c !important; }
.rf-error-msg {
    display: block;
    color: #e74c3c;
    font-size: 12px;
    margin-top: 5px;
}

/* Two-column password row */
.rf-row-two {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* Password toggle */
.rf-password-wrap { position: relative; }
.rf-password-wrap input { padding-right: 44px; }
.rf-toggle-pw {
    position: absolute;
    right: 13px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #aaa;
    font-size: 15px;
    padding: 0;
    line-height: 1;
}
.rf-toggle-pw:hover { color: #ff6b35; }

/* Strength bar */
.rf-strength-wrap {
    height: 4px;
    background: #eee;
    border-radius: 4px;
    margin: 4px 0 4px;
    overflow: hidden;
}
.rf-strength-bar {
    height: 100%;
    width: 0;
    border-radius: 4px;
    transition: width .4s, background .4s;
}
.rf-strength-label {
    font-size: 11px;
    color: #aaa;
    margin-bottom: 14px;
    min-height: 16px;
}

/* Terms */
.rf-terms {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: #555;
    margin-bottom: 22px;
    cursor: pointer;
    line-height: 1.5;
}
.rf-terms input[type="checkbox"] {
    width: 15px;
    height: 15px;
    margin-top: 2px;
    accent-color: #ff6b35;
    flex-shrink: 0;
    cursor: pointer;
}
.rf-terms a { color: #ff6b35; font-weight: 600; text-decoration: none; }
.rf-terms a:hover { text-decoration: underline; }

/* Submit */
.rf-submit-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #ff6b35, #f7931e);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 0.4px;
    transition: opacity .25s, transform .2s, box-shadow .25s;
    box-shadow: 0 6px 20px rgba(255,107,53,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.rf-submit-btn:hover {
    opacity: 0.92;
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(255,107,53,0.45);
}

/* Divider */
.rf-divider {
    text-align: center;
    margin: 22px 0;
    position: relative;
}
.rf-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0; right: 0;
    height: 1px;
    background: #eee;
}
.rf-divider span {
    position: relative;
    background: #fff;
    padding: 0 14px;
    color: #aaa;
    font-size: 13px;
}

/* Sign-in link button */
.rf-login-btn {
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
.rf-login-btn:hover {
    border-color: #1a1a2e;
    background: #f8f9fa;
    color: #1a1a2e;
    text-decoration: none;
}

/* ── Brand Panel (right) ── */
.reg-brand-panel {
    flex: 1;
    background: linear-gradient(145deg, #0f3460 0%, #1a1a2e 50%, #ff6b35 160%);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
}
.reg-brand-inner { position: relative; z-index: 2; }
.reg-logo img {
    height: 48px;
    margin-bottom: 36px;
    display: block;
    filter: brightness(0) invert(1);
}
.reg-brand-title {
    color: #fff;
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 14px;
    line-height: 1.3;
}
.reg-brand-sub {
    color: rgba(255,255,255,0.72);
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 36px;
}

/* Perks */
.reg-perks { display: flex; flex-direction: column; gap: 20px; }
.reg-perk {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.reg-perk-icon {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.12);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 17px;
    color: #ff6b35;
}
.reg-perk div { display: flex; flex-direction: column; gap: 3px; }
.reg-perk strong { color: #fff; font-size: 14px; font-weight: 700; }
.reg-perk span   { color: rgba(255,255,255,0.65); font-size: 13px; line-height: 1.5; }

/* Decorative circles */
.rp-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}
.rp-circle-1 { width: 340px; height: 340px; top: -100px; right: -120px; }
.rp-circle-2 { width: 200px; height: 200px; bottom: -70px; left: -70px; }

/* ── Responsive ── */
@media (max-width: 900px) {
    .reg-wrapper { flex-direction: column; margin: 20px 16px; border-radius: 12px; }
    .reg-brand-panel { order: -1; padding: 40px 30px; }
    .reg-brand-title { font-size: 22px; }
    .reg-form-panel  { padding: 40px 30px; }
    .rf-row-two { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .reg-form-panel  { padding: 28px 18px; }
    .reg-brand-panel { padding: 28px 18px; }
}
</style>
@endpush

@push('scripts')
<script>
function togglePw(inputId, iconId) {
    var input = document.getElementById(inputId);
    var icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'ti-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'ti-eye';
    }
}

/* Password strength meter */
document.getElementById('reg-password').addEventListener('input', function () {
    var val   = this.value;
    var bar   = document.getElementById('strength-bar');
    var label = document.getElementById('strength-label');
    var score = 0;

    if (val.length >= 8)              score++;
    if (/[A-Z]/.test(val))            score++;
    if (/[0-9]/.test(val))            score++;
    if (/[^A-Za-z0-9]/.test(val))     score++;

    var widths = ['0%', '25%', '50%', '75%', '100%'];
    var colors = ['#eee', '#e74c3c', '#f39c12', '#3498db', '#27ae60'];
    var labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];

    bar.style.width      = widths[score];
    bar.style.background = colors[score];
    label.textContent    = val.length ? labels[score] : '';
    label.style.color    = colors[score];
});
</script>
@endpush

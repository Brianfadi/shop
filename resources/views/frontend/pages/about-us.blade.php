@extends('frontend.layouts.master')

@section('title','About Us | Ecommerce Laravel')

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
                        <li class="active"><a href="javascript:void(0);">About Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- ===== HERO ABOUT SECTION ===== -->
<section class="about-hero-section" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 90px 0; position: relative; overflow: hidden;">
    <!-- decorative circles -->
    <div style="position:absolute;top:-60px;right:-60px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,0.04);"></div>
    <div style="position:absolute;bottom:-80px;left:-80px;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,0.03);"></div>

    <div class="container" style="position:relative;z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                <span style="display:inline-block;background:rgba(255,107,53,0.2);color:#ff6b35;padding:6px 18px;border-radius:30px;font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:20px;">Our Story</span>
                <h1 style="color:#fff;font-size:46px;font-weight:800;line-height:1.2;margin-bottom:20px;">
                    Welcome to <span style="color:#ff6b35;">Ecommerce</span> Laravel
                </h1>
                <p style="color:rgba(255,255,255,0.75);font-size:17px;line-height:1.8;margin-bottom:30px;">
                    We are a passionate team dedicated to delivering the best online shopping experience in Kenya. From quality products to seamless delivery, everything we do is built around you.
                </p>
                <p style="color:rgba(255,255,255,0.6);font-size:15px;line-height:1.8;margin-bottom:35px;">
                    @foreach($settings as $data) {{ $data->description }} @endforeach
                </p>
                <div class="d-flex flex-wrap" style="gap:12px;">
                    <a href="{{ route('product-grids') }}" class="btn" style="background:#ff6b35;color:#fff;border:none;padding:14px 32px;border-radius:4px;font-weight:600;font-size:15px;">Shop Now</a>
                    <a href="{{ route('contact') }}" class="btn" style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,0.4);padding:14px 32px;border-radius:4px;font-weight:600;font-size:15px;">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div style="position:relative;">
                    <div style="border-radius:12px;overflow:hidden;box-shadow:0 30px 80px rgba(0,0,0,0.4);">
                        <img src="@foreach($settings as $data) {{ $data->photo }} @endforeach"
                             alt="About Us"
                             style="width:100%;height:420px;object-fit:cover;display:block;">
                    </div>
                    <!-- floating badge -->
                    <div style="position:absolute;bottom:-20px;left:-20px;background:#ff6b35;color:#fff;padding:20px 24px;border-radius:10px;box-shadow:0 10px 30px rgba(255,107,53,0.4);text-align:center;">
                        <div style="font-size:32px;font-weight:800;line-height:1;">5+</div>
                        <div style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-top:4px;">Years of Trust</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== END HERO ===== -->

<!-- ===== STATS SECTION ===== -->
<section style="background:#fff;padding:60px 0;border-bottom:1px solid #f0f0f0;">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0">
                <div style="padding:20px;">
                    <div style="font-size:48px;font-weight:800;color:#ff6b35;line-height:1;">10K+</div>
                    <div style="font-size:14px;color:#777;font-weight:500;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Happy Customers</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0">
                <div style="padding:20px;border-left:1px solid #f0f0f0;">
                    <div style="font-size:48px;font-weight:800;color:#ff6b35;line-height:1;">500+</div>
                    <div style="font-size:14px;color:#777;font-weight:500;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Products Listed</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div style="padding:20px;border-left:1px solid #f0f0f0;">
                    <div style="font-size:48px;font-weight:800;color:#ff6b35;line-height:1;">50+</div>
                    <div style="font-size:14px;color:#777;font-weight:500;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Trusted Brands</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6">
                <div style="padding:20px;border-left:1px solid #f0f0f0;">
                    <div style="font-size:48px;font-weight:800;color:#ff6b35;line-height:1;">24/7</div>
                    <div style="font-size:14px;color:#777;font-weight:500;margin-top:8px;text-transform:uppercase;letter-spacing:1px;">Customer Support</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== END STATS ===== -->

<!-- ===== MISSION & VISION ===== -->
<section style="background:#f8f9fa;padding:90px 0;">
    <div class="container">
        <div class="row justify-content-center mb-60">
            <div class="col-lg-7 text-center">
                <span style="display:inline-block;background:#fff3ee;color:#ff6b35;padding:6px 18px;border-radius:30px;font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">What Drives Us</span>
                <h2 style="font-size:36px;font-weight:800;color:#1a1a2e;margin-bottom:16px;">Our Mission &amp; Vision</h2>
                <p style="color:#777;font-size:16px;line-height:1.8;">We believe shopping should be simple, affordable, and enjoyable for every Kenyan.</p>
            </div>
        </div>
        <div class="row" style="margin-top:40px;">
            <div class="col-lg-6 col-12 mb-4">
                <div style="background:#fff;border-radius:12px;padding:40px;height:100%;box-shadow:0 4px 30px rgba(0,0,0,0.06);border-top:4px solid #ff6b35;transition:transform .3s;">
                    <div style="width:60px;height:60px;background:#fff3ee;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <i class="ti-target" style="font-size:26px;color:#ff6b35;"></i>
                    </div>
                    <h3 style="font-size:22px;font-weight:700;color:#1a1a2e;margin-bottom:14px;">Our Mission</h3>
                    <p style="color:#666;font-size:15px;line-height:1.8;">To provide every customer in Kenya with access to quality products at fair prices, delivered fast and securely to their doorstep. We are committed to making online shopping trustworthy and accessible to all.</p>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-4">
                <div style="background:#fff;border-radius:12px;padding:40px;height:100%;box-shadow:0 4px 30px rgba(0,0,0,0.06);border-top:4px solid #1a1a2e;transition:transform .3s;">
                    <div style="width:60px;height:60px;background:#eef0ff;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <i class="ti-eye" style="font-size:26px;color:#1a1a2e;"></i>
                    </div>
                    <h3 style="font-size:22px;font-weight:700;color:#1a1a2e;margin-bottom:14px;">Our Vision</h3>
                    <p style="color:#666;font-size:15px;line-height:1.8;">To become East Africa's most loved e-commerce platform — a place where buyers find exactly what they need and sellers grow their businesses with confidence, powered by technology and driven by community.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== END MISSION & VISION ===== -->

<!-- ===== WHY CHOOSE US ===== -->
<section style="background:#fff;padding:90px 0;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <span style="display:inline-block;background:#fff3ee;color:#ff6b35;padding:6px 18px;border-radius:30px;font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">Why Us</span>
                <h2 style="font-size:36px;font-weight:800;color:#1a1a2e;margin-bottom:16px;">Why Choose Ecommerce Laravel?</h2>
                <p style="color:#777;font-size:16px;line-height:1.8;">We go the extra mile so you don't have to.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div style="text-align:center;padding:36px 24px;border-radius:12px;background:#f8f9fa;transition:all .3s;height:100%;">
                    <div style="width:70px;height:70px;background:#ff6b35;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                        <i class="ti-rocket" style="font-size:28px;color:#fff;"></i>
                    </div>
                    <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:10px;">Fast Delivery</h4>
                    <p style="color:#777;font-size:14px;line-height:1.7;">Free shipping on orders over KSh 100. We deliver across Kenya quickly and reliably.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div style="text-align:center;padding:36px 24px;border-radius:12px;background:#f8f9fa;transition:all .3s;height:100%;">
                    <div style="width:70px;height:70px;background:#1a1a2e;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                        <i class="ti-reload" style="font-size:28px;color:#fff;"></i>
                    </div>
                    <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:10px;">Easy Returns</h4>
                    <p style="color:#777;font-size:14px;line-height:1.7;">Not satisfied? Return any item within 30 days — no questions asked, no hassle.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div style="text-align:center;padding:36px 24px;border-radius:12px;background:#f8f9fa;transition:all .3s;height:100%;">
                    <div style="width:70px;height:70px;background:#ff6b35;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                        <i class="ti-lock" style="font-size:28px;color:#fff;"></i>
                    </div>
                    <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:10px;">Secure Payments</h4>
                    <p style="color:#777;font-size:14px;line-height:1.7;">Pay safely via M-Pesa, PayPal, or card. Your financial data is always protected.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div style="text-align:center;padding:36px 24px;border-radius:12px;background:#f8f9fa;transition:all .3s;height:100%;">
                    <div style="width:70px;height:70px;background:#1a1a2e;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                        <i class="ti-tag" style="font-size:28px;color:#fff;"></i>
                    </div>
                    <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:10px;">Best Prices</h4>
                    <p style="color:#777;font-size:14px;line-height:1.7;">We guarantee the best prices on all products. Find a lower price and we'll match it.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== END WHY CHOOSE US ===== -->

<!-- ===== OUR JOURNEY TIMELINE ===== -->
<section style="background:#f8f9fa;padding:90px 0;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <span style="display:inline-block;background:#fff3ee;color:#ff6b35;padding:6px 18px;border-radius:30px;font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;margin-bottom:16px;">Our Journey</span>
                <h2 style="font-size:36px;font-weight:800;color:#1a1a2e;margin-bottom:16px;">How We Got Here</h2>
                <p style="color:#777;font-size:16px;line-height:1.8;">A few milestones that shaped who we are today.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Timeline item -->
                <div style="display:flex;gap:24px;margin-bottom:40px;align-items:flex-start;">
                    <div style="flex-shrink:0;width:56px;height:56px;background:#ff6b35;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:13px;box-shadow:0 6px 20px rgba(255,107,53,0.35);">2019</div>
                    <div style="background:#fff;border-radius:10px;padding:24px 28px;flex:1;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                        <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:8px;">The Beginning</h4>
                        <p style="color:#666;font-size:14px;line-height:1.7;margin:0;">We launched with a small catalog of electronics and fashion items, serving customers in Nairobi with same-day delivery.</p>
                    </div>
                </div>
                <!-- Timeline item -->
                <div style="display:flex;gap:24px;margin-bottom:40px;align-items:flex-start;">
                    <div style="flex-shrink:0;width:56px;height:56px;background:#1a1a2e;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:13px;box-shadow:0 6px 20px rgba(26,26,46,0.3);">2021</div>
                    <div style="background:#fff;border-radius:10px;padding:24px 28px;flex:1;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                        <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:8px;">Nationwide Expansion</h4>
                        <p style="color:#666;font-size:14px;line-height:1.7;margin:0;">We expanded our delivery network to cover all 47 counties in Kenya and introduced M-Pesa payments for seamless checkout.</p>
                    </div>
                </div>
                <!-- Timeline item -->
                <div style="display:flex;gap:24px;margin-bottom:40px;align-items:flex-start;">
                    <div style="flex-shrink:0;width:56px;height:56px;background:#ff6b35;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:13px;box-shadow:0 6px 20px rgba(255,107,53,0.35);">2023</div>
                    <div style="background:#fff;border-radius:10px;padding:24px 28px;flex:1;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                        <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:8px;">10,000 Happy Customers</h4>
                        <p style="color:#666;font-size:14px;line-height:1.7;margin:0;">We hit a major milestone — 10,000 satisfied customers and over 500 products across multiple categories from trusted brands.</p>
                    </div>
                </div>
                <!-- Timeline item -->
                <div style="display:flex;gap:24px;align-items:flex-start;">
                    <div style="flex-shrink:0;width:56px;height:56px;background:#1a1a2e;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:13px;box-shadow:0 6px 20px rgba(26,26,46,0.3);">Now</div>
                    <div style="background:#fff;border-radius:10px;padding:24px 28px;flex:1;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                        <h4 style="font-size:17px;font-weight:700;color:#1a1a2e;margin-bottom:8px;">Growing Every Day</h4>
                        <p style="color:#666;font-size:14px;line-height:1.7;margin:0;">We continue to grow, adding new products, improving delivery times, and building the most trusted e-commerce platform in East Africa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== END TIMELINE ===== -->

<!-- ===== CTA BANNER ===== -->
<section style="background:linear-gradient(135deg,#ff6b35 0%,#f7931e 100%);padding:80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12 mb-4 mb-lg-0">
                <h2 style="color:#fff;font-size:34px;font-weight:800;margin-bottom:12px;">Ready to start shopping?</h2>
                <p style="color:rgba(255,255,255,0.85);font-size:17px;margin:0;">Explore hundreds of products with fast delivery across Kenya.</p>
            </div>
            <div class="col-lg-4 col-12 text-lg-right">
                <a href="{{ route('product-grids') }}" style="display:inline-block;background:#fff;color:#ff6b35;padding:16px 40px;border-radius:4px;font-weight:700;font-size:16px;text-decoration:none;box-shadow:0 8px 30px rgba(0,0,0,0.15);">Browse Products</a>
            </div>
        </div>
    </div>
</section>
<!-- ===== END CTA ===== -->

<!-- Newsletter -->
@include('frontend.layouts.newsletter')

@endsection

@push('styles')
<style>
    .about-hero-section .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    section [style*="border-radius:12px"]:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush

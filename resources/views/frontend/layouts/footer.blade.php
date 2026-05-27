
	<!-- Start Footer Area -->
	@php $settings = DB::table('settings')->get(); @endphp
	<footer class="footer">

		<!-- Footer Newsletter Strip -->
		<div class="footer-newsletter-strip">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-5 col-md-12">
						<div class="newsletter-text">
							<i class="ti-email"></i>
							<div>
								<h5>Subscribe to our Newsletter</h5>
								<p>Get the latest deals and offers straight to your inbox.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-md-12">
						<form class="footer-newsletter-form" action="#" method="POST">
							@csrf
							<input type="email" placeholder="Enter your email address...">
							<button type="submit">Subscribe <i class="ti-arrow-right"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Newsletter Strip -->

		<!-- Footer Main -->
		<div class="footer-main">
			<div class="container">
				<div class="row">

					<!-- About Column -->
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-footer footer-about">
							<div class="footer-logo">
								<a href="{{route('home')}}">
									<img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="Logo">
								</a>
							</div>
							<p class="footer-desc">@foreach($settings as $data) {{$data->short_des}} @endforeach</p>
							<div class="footer-contact-info">
								<div class="footer-contact-item">
									<i class="ti-location-pin"></i>
									<span>@foreach($settings as $data) {{$data->address}} @endforeach</span>
								</div>
								<div class="footer-contact-item">
									<i class="ti-email"></i>
									<span>@foreach($settings as $data) {{$data->email}} @endforeach</span>
								</div>
								<div class="footer-contact-item">
									<i class="ti-headphone-alt"></i>
									<span><a href="tel:@foreach($settings as $data){{$data->phone}}@endforeach">@foreach($settings as $data) {{$data->phone}} @endforeach</a></span>
								</div>
							</div>
						</div>
					</div>

					<!-- Quick Links Column -->
					<div class="col-lg-2 col-md-6 col-12">
						<div class="single-footer footer-links">
							<h4 class="footer-heading">Quick Links</h4>
							<ul>
								<li><a href="{{route('home')}}"><i class="ti-angle-right"></i> Home</a></li>
								<li><a href="{{route('about-us')}}"><i class="ti-angle-right"></i> About Us</a></li>
								<li><a href="{{route('product-grids')}}"><i class="ti-angle-right"></i> Products</a></li>
								<li><a href="{{route('blog')}}"><i class="ti-angle-right"></i> Blog</a></li>
								<li><a href="{{route('contact')}}"><i class="ti-angle-right"></i> Contact Us</a></li>
							</ul>
						</div>
					</div>

					<!-- Customer Service Column -->
					<div class="col-lg-2 col-md-6 col-12">
						<div class="single-footer footer-links">
							<h4 class="footer-heading">Customer Service</h4>
							<ul>
								<li><a href="#"><i class="ti-angle-right"></i> Payment Methods</a></li>
								<li><a href="#"><i class="ti-angle-right"></i> Money-back</a></li>
								<li><a href="#"><i class="ti-angle-right"></i> Returns</a></li>
								<li><a href="#"><i class="ti-angle-right"></i> Shipping</a></li>
								<li><a href="#"><i class="ti-angle-right"></i> Privacy Policy</a></li>
							</ul>
						</div>
					</div>

					<!-- Follow Us Column -->
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-footer footer-social-widget">
							<h4 class="footer-heading">Follow Us</h4>
							<p class="footer-social-desc">Stay connected with us on social media for the latest updates, offers, and news.</p>
							<div class="footer-social-icons">
								<a href="#" class="social-icon facebook" title="Facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="social-icon twitter" title="Twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="social-icon instagram" title="Instagram"><i class="fa fa-instagram"></i></a>
								<a href="#" class="social-icon youtube" title="YouTube"><i class="fa fa-youtube"></i></a>
								<a href="#" class="social-icon linkedin" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
							</div>
							<div class="footer-badges">
								<div class="footer-badge"><i class="ti-rocket"></i> Free Shipping over KSh 100</div>
								<div class="footer-badge"><i class="ti-reload"></i> 30-Day Returns</div>
								<div class="footer-badge"><i class="ti-lock"></i> Secure Payments</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Footer Main -->

		<!-- Footer Bottom / Copyright -->
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-inner">
					<div class="footer-bottom-left">
						<p>© {{date('Y')}} <span class="brand-name">ShopEase</span> &mdash; Developed by <a href="#">Brian Owaka</a>. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Bottom -->

	</footer>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('frontend/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('frontend/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
	{{-- Isotope --}}
	<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('frontend/js/easing.js')}}"></script>

	<!-- Active JS -->
	<script src="{{asset('frontend/js/active.js')}}"></script>

	
	@stack('scripts')
	<script>
		setTimeout(function(){
		  $('.alert').slideUp();
		},5000);
		$(function() {
		// ------------------------------------------------------- //
		// Multi Level dropdowns
		// ------------------------------------------------------ //
			$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
				event.preventDefault();
				event.stopPropagation();

				$(this).siblings().toggleClass("show");


				if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
				$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
				});

			});
		});
	  </script>
<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title>Resido - Residence & Real Estate HTML Template</title>	
		
        <!-- Custom CSS -->
        <link href="{{ asset('assets/resido/css/styles.css') }}" rel="stylesheet">
		
		<!-- Custom Color Option -->
		<link href="{{ asset('assets/resido/css/colors.css') }}" rel="stylesheet">
		
        @yield('css')
    </head>
	
    <body class="blue-skin">
	
		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            <!-- Start Navigation -->
			<div class="header header-transparent dark">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="#">
								<img src="{{ asset('assets/resido/img/logo-mud.png') }}" class="logo" alt="" />
							</a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu">
								<li class=""><a href="#">Home</a></li>
								<li class=""><a href="#">Contact</a></li>
                                <li class=""><a href="#">Faq</a></li>
							</ul>
							
							<ul class="nav-menu nav-menu-social align-to-right">
								
								<li>
									<a href="{{ route('register') }}" class="text-light-theme">Sign up</a>
								</li>
                                @if(Auth::check())
								<li>
									<a href="{{ route('manage-url.index') }}" class="text-light-theme"><i class="ti-user"></i></a>
								</li>
                                @else
                                <li>
									<a href="{{ route('login') }}" class="text-light-theme">Sign in</a>
								</li>
                                @endif
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
            @yield('content')
			
			<!-- ============================ Footer Start ================================== -->
			<footer class="dark-footer skin-dark-footer">
				<div>
					<div class="container">
						<div class="row">
							
							<div class="col-lg-3 col-md-4">
								<div class="footer-widget">
									<img src="{{ asset('assets/resido/img/logo-light.png') }}" class="img-footer" alt="" />
									<div class="footer-add">
										<p>Collins Street West, Victoria 8007, Australia.</p>
										<p>+1 246-345-0695</p>
										<p>info@example.com</p>
									</div>
									
								</div>
							</div>		
							<div class="col-lg-2 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title">Navigations</h4>
									<ul class="footer-menu">
										<li><a href="about-us.html">About Us</a></li>
										<li><a href="faq.html">FAQs Page</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="contact.html">Contact</a></li>
										<li><a href="blog.html">Blog</a></li>
									</ul>
								</div>
							</div>
									
							<div class="col-lg-2 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title">The Highlights</h4>
									<ul class="footer-menu">
										<li><a href="#">Apartment</a></li>
										<li><a href="#">My Houses</a></li>
										<li><a href="#">Restaurant</a></li>
										<li><a href="#">Nightlife</a></li>
										<li><a href="#">Villas</a></li>
									</ul>
								</div>
							</div>
							
							<div class="col-lg-2 col-md-6">
								<div class="footer-widget">
									<h4 class="widget-title">My Account</h4>
									<ul class="footer-menu">
										<li><a href="#">My Profile</a></li>
										<li><a href="#">My account</a></li>
										<li><a href="#">My Property</a></li>
										<li><a href="#">Favorites</a></li>
										<li><a href="#">Cart</a></li>
									</ul>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-6">
								<div class="footer-widget">
									<h4 class="widget-title">Download Apps</h4>
									<a href="#" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="lni-playstore theme-cl"></i>
											</div>
											<div class="os-app-caps">
												Google Play
												<span>Get It Now</span>
											</div>
										</div>
									</a>
									<a href="#" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="lni-apple theme-cl"></i>
											</div>
											<div class="os-app-caps">
												App Store
												<span>Now it Available</span>
											</div>
										</div>
									</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center">
							
							<div class="col-lg-6 col-md-6">
								<p class="mb-0">© 2021 Resido. Designd By <a href="https://themezhub.com">Themez Hub</a> All Rights Reserved</p>
							</div>
							
							<div class="col-lg-6 col-md-6 text-right">
								<ul class="footer-bottom-social">
									<li><a href="#"><i class="ti-facebook"></i></a></li>
									<li><a href="#"><i class="ti-twitter"></i></a></li>
									<li><a href="#"><i class="ti-instagram"></i></a></li>
									<li><a href="#"><i class="ti-linkedin"></i></a></li>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->
			
			<!-- Sign Up Modal -->
			<div class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
					<div class="modal-content" id="sign-up">
						<span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
						<div class="modal-body">
							<h4 class="modal-header-title">Sign Up</h4>
							<div class="login-form">
								<form>
									
									<div class="row">
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" class="form-control" placeholder="Full Name">
													<i class="ti-user"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="email" class="form-control" placeholder="Email">
													<i class="ti-email"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" class="form-control" placeholder="Username">
													<i class="ti-user"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="password" class="form-control" placeholder="*******">
													<i class="ti-unlock"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="password" class="form-control" placeholder="123 546 5847">
													<i class="lni-phone-handset"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<select class="form-control">
														<option>As a Customer</option>
														<option>As a Agent</option>
														<option>As a Agency</option>
													</select>
													<i class="ti-briefcase"></i>
												</div>
											</div>
										</div>
										
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-md full-width btn-theme-light-2 rounded">Sign Up</button>
									</div>
								
								</form>
							</div>
							<div class="modal-divider"><span>Or login via</span></div>
							<div class="social-login mb-3">
								<ul>
									<li><a href="#" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
									<li><a href="#" class="btn connect-google"><i class="ti-google"></i>Google+</a></li>
								</ul>
							</div>
							<div class="text-center">
								<p class="mt-5"><i class="ti-user mr-1"></i>Already Have An Account? <a href="#" class="link">Go For LogIn</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
			
			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{ asset('assets/resido/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/resido/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets/resido/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/resido/js/rangeslider.js') }}"></script>
		<script src="{{ asset('assets/resido/js/select2.min.js') }}"></script>
		<script src="{{ asset('assets/resido/js/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('assets/resido/js/slick.js') }}"></script>
		<script src="{{ asset('assets/resido/js/slider-bg.js') }}"></script>
		<script src="{{ asset('assets/resido/js/lightbox.js') }}"></script> 
		<script src="{{ asset('assets/resido/js/imagesloaded.js') }}"></script>
		 
		<script src="{{ asset('assets/resido/js/custom.js') }}"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->

        @yield('js')
	</body>
</html>
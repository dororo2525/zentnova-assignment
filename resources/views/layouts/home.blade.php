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
							<ul class="nav-menu nav-menu-social align-to-right">
								
								<li>
									<a href="{{ route('register') }}" class="text-light-theme">Sign up</a>
								</li>
                                @if(Auth::check())
								<li>
									<a href="{{ route('manage-url.index') }}" class="text-light-theme">Dashboard</a>
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
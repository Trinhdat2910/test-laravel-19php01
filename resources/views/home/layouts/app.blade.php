<!DOCTYPE HTML>
<html>
	<head>
	<title>Footwear Shop</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('layout_home/css/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('layout_home/css/icomoon.css')}}">
	<!-- Ion Icon Fonts-->
	<link rel="stylesheet" href="{{asset('layout_home/css/ionicons.min.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('layout_home/css/bootstrap.min.css')}}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('layout_home/css/magnific-popup.css')}}">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{asset('layout_home/css/flexslider.css')}}">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{asset('layout_home/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('layout_home/css/owl.theme.default.min.css')}}">

	<!-- Date Picker -->
	<link rel="stylesheet" href="{{asset('layout_home/css/bootstrap-datepicker.css')}}">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="{{asset('layout_home/fonts/flaticon/font/flaticon.css')}}">
	<link href="{{ asset('layout_home/toastr/toastr.min.css') }}" rel="stylesheet">
	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('layout_home/css/style.css')}}">

	</head>
	<body>

	<div class="colorlib-loader"></div>

	<div id="page">
		@include('home.layouts.header')
		@include('home.layouts.aside')
		@yield('content_home')
		@include('home.layouts.footer')
		
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>

	<!-- jQuery -->
	<script src="{{asset('layout_home/js/jquery.min.js')}}"></script>
   <!-- popper -->
   <script src="{{asset('layout_home/js/popper.min.js')}}"></script>
   <!-- bootstrap 4.1 -->
   <script src="{{asset('layout_home/js/bootstrap.min.js')}}"></script>
   <!-- jQuery easing -->
   <script src="{{asset('layout_home/js/jquery.easing.1.3.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('layout_home/js/jquery.waypoints.min.js')}}"></script>
	<!-- Flexslider -->
	<script src="{{asset('layout_home/js/jquery.flexslider-min.js')}}"></script>
	<!-- Owl carousel -->
	<script src="{{asset('layout_home/js/owl.carousel.min.js')}}"></script>
	<!-- Magnific Popup -->
	<script src="{{asset('layout_home/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('layout_home/js/magnific-popup-options.js')}}"></script>
	<!-- Date Picker -->
	<script src="{{asset('layout_home/js/bootstrap-datepicker.js')}}"></script>
	<!-- Stellar Parallax -->
	<script src="{{asset('layout_home/js/jquery.stellar.min.js')}}"></script>
	
    <script src="{{ asset('layout_home/toastr/toastr.min.js') }}"></script>
	<!-- Main -->
	<script src="{{asset('layout_home/js/main.js')}}"></script>
	@yield('script_home')
	</body>
</html>

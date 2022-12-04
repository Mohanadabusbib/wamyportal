<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="WAMY">
        <meta name="Author" content="Mohanad Abusbib">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="Keywords" content=""/>
		@include('layouts.head')
		
			@yield('js-Geny')
			
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('public/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')
			<!-- container -->
			<div class="container-fluid">

				@yield('page-header')
                @yield('content')

				@include('layouts.sidebar')
				@include('layouts.models')
				@include('layouts.footer')
                @include('layouts.footer-scripts')
            </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
	</body>
	<script>
		setInterval(function() {
			$("#notifications_count").load(window.location.href + " #notifications_count");
			$("#unreadNotifications").load(window.location.href + " #unreadNotifications");
		}, 5000);
	</script>
	
</html>

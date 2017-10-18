<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
    <!-- https://stackoverflow.com/questions/44769250/incompatible-units-rem-and-px-with-bootstrap-4-alpha-6-->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/toggle-button.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
		
		@yield('css')
		
		<script>
			window.Laravel = {!! json_encode([
				'csrfToken' => csrf_token(),
			]) !!};
		</script>
	</head>
	<body>
		@include('shared.header')
		<div class="app-body">
			<div class="sidebar-nav">
				@include('shared.navbar')
			</div>
			<div class="content">
				<ol class="breadcrumb">
					@if(!empty($breadcrumb))
						@foreach($breadcrumb as $text => $url)
							@if(empty($url))
								<li>{{ $text }}</li>
							@else
								<li><a href="{{ $url }}">{{ $text }}</a></li>
							@endif
						@endforeach
					@endif
				</ol>
				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
		</div>
		@include('shared.footer')
   
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
		@yield('javascript')
	</body>
</html>
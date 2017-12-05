<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<!-- https://stackoverflow.com/questions/44769250/incompatible-units-rem-and-px-with-bootstrap-4-alpha-6-->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-icon.css') }}">
		<link rel="stylesheet" href="{{ asset('css/toggle-button.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-dialog-fix.css') }}">   
		<link rel="search" type="application/opensearchdescription+xml" title="Search through LyricDB" href="https://lyricdb.tk/opensearch.xml">
		<title>{{ config('app.name', 'Laravel') }}</title>
    <style>
  		@yield('css')
		</style>
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="/js/assets/TestApp.js"></script>
		<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
    <script type="text/javascript">
    		@yield('javascript')
    </script>
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
						@foreach($breadcrumb as $text => $url_or_array)
              @if(is_array($url_or_array))
                <li>
                  <ol>
                    @foreach($url_or_array as $item_text => $item_url)
                      @if(empty($item_url))
                        <li>{{ $item_text }}</li>
                      @else
                        <li><a href="{{ $item_url }}">{{ $item_text }}</a></li>
                      @endif
                    @endforeach
                  </ol>
                </li>
							@elseif(empty($url_or_array))
								<li>{{ $text }}</li>
							@else
								<li><a href="{{ $url_or_array }}">{{ $text }}</a></li>
							@endif
						@endforeach
					@endif
				</ol>
				<div class="container-fluid">
					@yield('content')
          @include('shared.pager')
				</div>
			</div>
		</div>
		@include('shared.footer')
	</body>
</html>
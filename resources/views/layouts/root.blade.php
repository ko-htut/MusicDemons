<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-89371074-3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-89371074-3');
		</script>

		<!-- https://stackoverflow.com/questions/44769250/incompatible-units-rem-and-px-with-bootstrap-4-alpha-6-->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="MusicDemons is an open-source and open-data project where artists and songs can be entered. This data is accessible through a public API-endpoint">
		<meta name="keywords" content="music,lyrics,database,api,open-source,open-data">
		<meta name="author" content="Pieterjan De Clippel">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/menu-icon.css') }}">
		<link rel="stylesheet" href="{{ asset('css/toggle-button.css') }}">
		<link rel="stylesheet" href="{{ asset('css/fancy-scrollbar.css') }}">
		<link rel="stylesheet" href="{{ asset('css/breadcrumb.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap-xtra.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap-dialog-fix.css') }}">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
		<link rel="shortcut icon" href="{{ asset('img/music_note.png') }}">
		<link rel="search" type="application/opensearchdescription+xml" title="Search through MusicDemons" href="{{ url('opensearch.xml') }}">
		@section('title')
			<title>{{ config('app.name', 'Laravel') }} - First Open-Source and Open-Data Music/Lyrics Database</title>
		@endsection
		@yield('title')
		<style>
			@yield('css')
		</style>
		<script>
			window.Laravel = {!! json_encode([
				'csrfToken' => csrf_token(),
			]) !!};
		</script>
	</head>
	<body>
		@include('shared.header')
		<div class="app-body sidebar-auto" id="app-body">
			<div class="sidebar">
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
    @yield('pre_scripts')
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/custom/classHelper.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/custom/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom/checkbuttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom/rowsclickable.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
    @yield('scripts')
    <script type="text/javascript">
    		@yield('javascript')
    </script>
    @yield('post_scripts')
	</body>
</html>
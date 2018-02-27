@extends('layouts.root')

@section('content')
    <h1>MusicDemons: Home</h1>
    <p class="text-center">
        MusicDemons is an open-source, open-data project.
        This means that anyone can access the data in the database through a public API-endpoint.
        The source-code is hosted on <a href="https://github.com/PieterjanDeClippel/LyricDB" target="_blank">GitHub</a>.
        If you&#34;d wish to make an application based on the data in this database, take a look at the <a href="{{ route('about.api') }}">API specifications</a>.
    </p>
    <h1>Follow us</h1>
    <p class="text-center">
        <a href="https://www.facebook.com/MusicDemons" target="_blank" title="Facebook">
            <img src="/img/facebook.png" width="64" height="64">
        </a>
        &nbsp;
        <a href="https://plus.google.com/communities/110589602488168149895" target="_blank" title="Google+">
            <img src="https://ssl.gstatic.com/images/branding/product/1x/google_plus_192dp.png" width="64" height="64">
        </a>
        <a href="https://twitter.com/MusicDemonsSite" target="_blank" title="Twitter">
            <img src="/img/twitter.png" width="64" height="64">
        </a>
        <a href="https://github.com/PieterjanDeClippel/LyricDB" target="_blank" title="GitHub">
            <img src="https://github.com/fluidicon.png" width="64" height="64">
        </a>
        <a href="https://www.linkedin.com/company/11488724/admin/updates/" target="_blank" title="LinkedIn">
            <img src="/img/linkedin.ico" width="64" height="64">
        </a>
    </p>
@endsection
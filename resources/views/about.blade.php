@extends('layouts.root')

@section('content')
	  <form action="{{ route('about.sendmail') }}" method="POST">
         {{ csrf_field() }}
        <div class="form-group row">
            <div class="col-md-12">
                <h4>About</h4>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <blockquote class="blockquote">
                    <p>
                        This is an open-source project built to collect as many songs, artists, people and albums as possible. The target of this project is to make the data available to anyone who wants to use it. This will be done through a webservice which is unconditionally available for anyone who wants to use it.
                    </p>
                    <p>
                        This webapplication is written in Laravel. The source files are available on <a href="https://github.com/PieterjanDeClippel/LyricDB" target="_blank">GitHub</a>.
                    </p>
                    <footer>&copy; LyricDB</footer>
                </blockquote>
            </div>
        </div>
        @if(Auth::check())
            <div class="form-group row">
                <div class="col-md-12">
                    <h4>Contact</h4>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <textarea class="form-control" rows="10" name="message" id="message"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa fa-send"></i>
                        Send
                    </button>
                </div>
            </div>
        @endif
    </form>
@endsection
@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Not found</title>
@endsection

@section('content')
    <div class="error-page">
        <h1 class="headline text-info">404</h1>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{ route('home.index') }}">return to the homepage</a> or try using the search form.
            </p>
        </div>
    </div>
@endsection
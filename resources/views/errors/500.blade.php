@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Internal server error</title>
@endsection

@section('content')    <div class="error-page">
    <h2 class="headline text-info"> 500</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Internal server error.</h3>
        <p>
            An internal server error occured
        </p>
    </div>
@endsection
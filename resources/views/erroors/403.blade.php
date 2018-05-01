@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Forbidden</title>
@endsection

@section('content')    <div class="error-page">
    <h1 class="headline text-info">403</h1>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Forbidden.</h3>
        <p>
            Forbidden
        </p>
    </div>
@endsection
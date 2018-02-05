@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Message sent</title>
@endsection

@section('content')
    <blockquote class="blockquote my-0">
        Your message has been sent
    </blockquote>
@endsection
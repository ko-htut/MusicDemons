@extends('layouts.root')

@section('title')
  <title>LyricDB - Home</title>
@endsection

@section('content')
    <h1>Home</h1>
    <div id="app">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
@endsection
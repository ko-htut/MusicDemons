@extends('layouts.root')

@section('content')
  @foreach($method_names as $method)
    {{ $method }}<br>
  @endforeach
@endsection
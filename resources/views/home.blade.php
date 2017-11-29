@extends('layouts.root')

@section('content')
    <h1>Home</h1>
    <div ng-app="TestApp" ng-controller="TestApp as vm">
        @{{ vm.Tekst }}
        <br>
        <button ng-click="vm.BtnClick()">Verander tekst</button>
    </div>
    <script type="text/javascript" src="/js/assets/TestApp.js"></script>
@endsection
@extends('layouts.root')

@section('content')
    <h1>Home</h1>
    <div ng-app="TestApp" ng-controller="TestApp as vm">
        @{{ vm.Message }}
        <br>
        <button ng-click="vm.BtnClick()">Verander tekst</button>
    </div>
@endsection
@extends('layouts.root')

@section('content')
	<form action="{{ route('artist.store') }}" method="POST">
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Create artist</h4>
            <span class="float-right">
                <button type="submit" class="btn btn-primary">
          					<i class="fa fa-save"></i>
          					Create artist
        				</button>
            </span>
        </div>
    </div>
		{{ csrf_field() }}
		@component('generic.form.text', [
			'name'      =>  'name',
			'label'     =>  'Artist name',
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_started',
			'label'     =>  'Year started',
			'required'  =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_quit',
			'label'     =>  'Year quit',
			'required'  =>  false
		])@endcomponent
	</form>
  <div ng-app="ArtistCreateApp" ng-controller="ArtistCreateApp as vm">
      @{{ vm.message }}
  </div>
@endsection
@section('javascript')
	<script type="text/javascript" src="{{ asset('js/angularjs/artist/create_app.js') }}"></script>
@endsection
@extends('layouts.root')

@section('content')
  <div class="row">
      <div class="col-12">
          <h4 class="d-inline-block">{{ $artist->name }}</h4>
          <span class="float-right">
              <a href="{{ route('artist.edit', $artist) }}" class="btn btn-primary">
            		<i class="fa fa-pencil"></i> Edit
            	</a>
          </span>
      </div>
  </div>
	@component('generic.form.label', [
		'label'     =>  'Artist name',
		'value'     =>  $artist->name
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Year started',
		'value'     =>  $artist->year_started
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Year quit',
		'value'     =>  $artist->year_quit
	])@endcomponent
@endsection
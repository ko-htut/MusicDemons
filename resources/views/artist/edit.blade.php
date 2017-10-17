@extends('layouts.root')

@section('content')
	<form action="{{ route('artist.update',$artist->id) }}" method="POST">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Edit artist: {{ $artist->name }}</h4>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update artist
        				</button>
            </span>
        </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'name',
			'label'     =>  'Artist name',
      'value'     =>  $artist->name,
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_started',
			'label'     =>  'Year started',
      'value'     =>  $artist->year_started,
			'required'  =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_quit',
			'label'     =>  'Year quit',
      'value'     =>  $artist->year_quit,
			'required'  =>  false
		])@endcomponent
	</form>
@endsection
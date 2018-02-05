@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Edit medium-type: {{ $mediumtype->description }}</title>
@endsection

@section('content')
	<form action="{{ route('mediumtypes.update',$mediumtype->id) }}" method="POST">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Edit medium type: {{ $mediumtype->description }}</h4>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update medium type
        				</button>
            </span>
        </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'description',
			'label'     =>  'Description',
      'value'     =>  $mediumtype->description,
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'base_url',
			'label'     =>  'Base URL',
      'value'     =>  $mediumtype->base_url,
			'required'  =>  true
		])@endcomponent
	</form>
@endsection
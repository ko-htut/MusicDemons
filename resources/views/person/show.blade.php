@extends('layouts.root')

@section('content')
  <div class="row">
      <div class="col-12">
          <h4 class="d-inline-block">{{ $person->first_name . " " . $person->last_name }}</h4>
          <span class="float-right">
              <a href="{{ route('person.edit', $person) }}" class="btn btn-primary">
            		<i class="fa fa-pencil"></i> Edit
            	</a>
          </span>
      </div>
  </div>
	@component('generic.form.label', [
		'label'     =>  'First name',
		'value'     =>  $person->first_name
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Last name',
		'value'     =>  $person->last_name
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Birth day',
		'value'     =>  ($person->born !== null ? date('d-m-Y',strtotime($person->born)) : '')
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Birth place',
		'value'     =>  $person->birth_place
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Died',
		'value'     =>  ($person->died !== null ? date('d-m-Y',strtotime($person->died)) : '')
	])@endcomponent
@endsection
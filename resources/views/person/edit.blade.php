@extends('layouts.root')

@section('content')
	<form action="{{ route('person.update',$person->id) }}" method="POST">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Edit person: {{ $person->name }}</h4>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update person
        				</button>
            </span>
        </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'first_name',
			'label'     =>  'First name',
      'value'     =>  $person->first_name,
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'last_name',
			'label'     =>  'Last name',
      'value'     =>  $person->last_name,
			'required'  =>  true
		])@endcomponent
		@component('generic.form.date', [
			'name'      =>  'born',
			'label'     =>  'Birth day',
      'value'     =>  date('Y-m-d',strtotime($person->born))
		])@endcomponent
    @component('generic.form.text',[
        'name'    =>  'birth_place',
        'label'   =>  'Birth place',
        'value'   =>  $person->birth_place
    ])@endcomponent
    @component('generic.form.date',[
        'name'    =>  'died',
        'label'   =>  'Died',
        'value'   =>  date('Y-m-d',strtotime($person->died))
    ])@endcomponent
	</form>
@endsection
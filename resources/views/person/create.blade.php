@extends('layouts.root')

@section('content')
	<form action="{{ route('person.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-12">
				<h4 class="d-inline-block">Create person</h4>
				<span class="float-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create person
					</button>
				</span>
			</div>
		</div>
    @component('generic.form.text',[
        'name'      =>  'first_name',
        'label'     =>  'First name',
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'last_name',
        'label'     =>  'Last name',
        'required'  =>  true
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'born',
        'label'     =>  'Birth day'
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'birth_place',
        'label'     =>  'Birth place'
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'died',
        'label'     =>  'Died'
    ])@endcomponent
  </form>
@endsection
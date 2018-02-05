@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Add medium-type</title>
@endsection

@section('content')
	<form action="{{ route('mediumtypes.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-12">
				<h4 class="d-inline-block">Create new media type</h4>
				<span class="float-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create Media-type
					</button>
				</span>
			</div>
		</div>
    @component('generic.form.text',[
        'name'      =>  'description',
        'label'     =>  'Description',
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'base_url',
        'label'     =>  'Base URL',
        'required'  =>  true
    ])@endcomponent
  </form>
@endsection

@extends('layouts.root')

@section('title')
  <title>LyricDB - Profile</title>
@endsection

@section('content')
	<form action="{{ route('profile.store') }}" method="POST">
		{{ csrf_field() }}
    <div class="form-group row">
      <div class="col-12">
        <h4 class="d-inline-block">Profile</h4>
        <span class="float-right">
  				<button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i>
            Update profile
          </button>
        </span>
      </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'name',
			'label'     =>  'Name',
			'required'  =>  true,
			'autofocus' =>  true,
      'value'     =>  $user->name
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'email',
			'label'     =>  'Email address',
      'value'     =>  $user->email,
      'disabled'  =>  true
		])@endcomponent
		@component('generic.form.password', [
			'name'        =>  'password',
			'label'       =>  'Password',
      'required'    =>  false,
      'placeholder' =>  'Leave empty to keep your password'
		])@endcomponent
		@component('generic.form.password', [
			'name'      =>  'password_confirmation',
			'label'     =>  'Repeat password',
      'required'  =>  false
		])@endcomponent
	</form>
@endsection
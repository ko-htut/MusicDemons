@extends('layouts.root')

@section('content')
	<h4>Profile</h4>
	<form action="{{ route('profile.store') }}" method="POST">
		{{ csrf_field() }}
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
		<div class="row">
			<div class="col-12 text-center">
				<button type="submit" class="btn btn-primary">
          <i class="fa fa-save"></i>
          Update profile
        </button>
			</div>
		</div>
	</form>
@endsection
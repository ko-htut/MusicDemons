@extends('layouts.root')

@section('content')
	<h1>Create an account</h1>
	<form action="{{ route('register') }}" method="POST">
		{{ csrf_field() }}
		@component('generic.form.text', [
			'name'      =>  'name',
			'label'     =>  'Name',
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'email',
			'label'     =>  'Email address',
			'required'  =>  true
		])@endcomponent
		@component('generic.form.password', [
			'name'      =>  'password',
			'label'     =>  'Password',
			'required'  =>  true
		])@endcomponent
		@component('generic.form.password', [
			'name'      =>  'password_confirmation',
			'label'     =>  'Repeat password',
			'required'  =>  true
		])@endcomponent
		<div class="row">
			<div class="col-12 text-center">
				<button type="submit" class="btn btn-primary">Create account</button>
			</div>
		</div>
	</form>
@endsection
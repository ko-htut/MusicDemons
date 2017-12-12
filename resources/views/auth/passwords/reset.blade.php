@extends('layouts.root')

@section('title')
  <title>LyricDB - Reset password</title>
@endsection

@section('content')
	<h1>Reset password</h1>
	<form action="{{ route('password.request') }}" method="POST">
		{{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $token }}">
		@component('generic.form.text', [
			'name'      =>  'email',
			'label'     =>  'email',
			'required'  =>  true
		])@endcomponent
		@component('generic.form.password', [
			'name'      =>  'password',
			'label'     =>  'Password',
			'required'  =>  true
		])@endcomponent
		@component('generic.form.password', [
			'name'      =>  'password_confirmation',
			'label'     =>  'Confirm password',
			'required'  =>  true
		])@endcomponent
		<div class="row">
			<div class="col-12 text-center">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-undo"></i>
					Reset password
				</button>
			</div>
		</div>
	</form>
@endsection
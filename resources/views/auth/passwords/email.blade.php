@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Send password reset link</title>
@endsection

@section('content')
	<h1>Reset password</h1>
	<form action="{{ route('password.email') }}" method="POST">
		{{ csrf_field() }}
		@component('generic.form.text', [
			'name'      =>  'email',
			'label'     =>  'Email address',
			'required'  =>  true
		])@endcomponent
		<div class="row">
			<div class="col-12 text-center">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-envelope"></i>
					Send Password Reset Link
				</button>
			</div>
		</div>
	</form>
@endsection
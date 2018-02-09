@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Edit {{ $person->full_name }}</title>
@endsection

@section('content')
	<form action="{{ route('person.update',$person->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Edit person: {{ $person->full_name }}</h4>
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
		@component('generic.form.text', [
			'name'      =>  'nickname',
			'label'     =>  'Nickname',
      'value'     =>  $person->nickname
		])@endcomponent
		@component('generic.form.date', [
			'name'      =>  'born',
			'label'     =>  'Birth day',
      'value'     =>  $person->born
		])@endcomponent
    @component('generic.form.select2',[
      'name'            =>  'birth_place',
      'label'           =>  'Birth place',
      'multiple'        =>  false,
      'ajax'            =>  [
				'url'             =>  'https://adres-autocomplete.pieterjan.pro/api/v1/place/autocomplete',
        'method'          =>  'post'
			],
      'selected'      =>  $person->birth_place,
      'model'         =>  'App\\Entities\\Place'
    ])@endcomponent
    @component('generic.form.date',[
        'name'    =>  'died',
        'label'   =>  'Died',
        'value'   =>  $person->died
    ])@endcomponent
    @component('generic.form.file',[
        'name'      =>  'picture',
        'label'     =>  'Image',
        'accept'    =>  'image/*',
        'required'  =>  false
    ])@endcomponent
    <div class="form-group row">
        <label class="col-sm-4 col-xl-2">Media</label>
        <div class="col-sm-8 col-xl-10">
            @component('subject.media',[
                'medium_types'  =>  $medium_types,
		            'media'         => count($old_media) !== 0 ? $old_media : $person->subject->media
            ])@endcomponent
        </div>
    </div>
	</form>
@endsection

@section('javascript')
    @include('subject.media_js')
@endsection
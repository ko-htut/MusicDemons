@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Edit {{ $artist->name }}</title>
@endsection

@section('content')
	<form action="{{ route('artist.update',$artist) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h1 class="d-inline-block">Edit artist: {{ $artist->name }}</h1>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update artist
        				</button>
            </span>
        </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'name',
			'label'     =>  'Artist name',
      'value'     =>  $artist->name,
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_started',
			'label'     =>  'Year started',
      'value'     =>  $artist->year_started,
			'required'  =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_quit',
			'label'     =>  'Year quit',
      'value'     =>  $artist->year_quit,
			'required'  =>  false
		])@endcomponent
    @component('generic.form.select2',[
      'name'          =>  'members',
      'label'         =>  'Current members',
      'multiple'      =>  true,
      'ajax'          =>  [
				'url'           =>  route('autocomplete-select2person', ['search' => ''])
			],
      'selected'      =>  $active_members,
      'model'         =>  'App\\Entities\\Person'
    ])@endcomponent
    @component('generic.form.select2',[
      'name'          =>  'past_members',
      'label'         =>  'Past members',
      'multiple'      =>  true,
      'ajax'          =>  [
				'url'           =>  route('autocomplete-select2person', ['search' => ''])
			],
      'selected'      =>  $past_members,
      'model'         =>  'App\\Entities\\Person'
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
              'medium_types'  => $medium_types,
		          'media'         => count($old_media) !== 0 ? $old_media : $artist->subject->media
          ])@endcomponent
      </div>
    </div>
	</form>
@endsection

@section('javascript')
    @include('subject.media_js')
@endsection
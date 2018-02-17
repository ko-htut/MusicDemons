@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Edit {{ $song->title }}</title>
@endsection

@section('content')
	<form action="{{ route('song.update',$song->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h1 class="d-inline-block">Edit song: {{ $song->title }}</h1>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update song
        				</button>
            </span>
        </div>
    </div>
    @component('generic.form.text',[
        'name'      =>  'title',
        'label'     =>  'Title',
        'value'     =>  $song->title,
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'released',
        'label'     =>  'Released',
        'value'     =>  $song->released
    ])@endcomponent
    @component('generic.form.select2',[
      'name'          =>  'artists',
      'label'         =>  'Artists',
      'multiple'      =>  true,
      'ajax'          =>  [
				'url'           =>  route('autocomplete-select2artist', ['search' => ''])
			],
      'selected'      =>  $selected_artists,
      'model'         =>  'App\\Entities\\Artist'
    ])@endcomponent
    @component('generic.form.textarea',[
        'name'     => 'lyrics',
        'label'    => 'Lyrics',
        'value'    => $song->lyrics->count() === 0 ? '' : $song->lyrics->last()->lyrics,
        'required' => false
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
              'media'         => count($old_media) !== 0 ? $old_media : $song->subject->media
          ])@endcomponent
      </div>
    </div>
	</form>
@endsection

@section('javascript')
    @include('subject.media_js')
@endsection
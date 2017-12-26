@extends('layouts.root')

@section('title')
  <title>LyricDB - Add Song</title>
@endsection

@section('content')
	<form action="{{ route('song.store') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-12">
				<h4 class="d-inline-block">Create song</h4>
				<span class="float-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create song
					</button>
				</span>
			</div>
		</div>
    @component('generic.form.text',[
        'name'      =>  'title',
        'label'     =>  'Title',
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'released',
        'label'     =>  'Released'
    ])@endcomponent
    @component('generic.form.select2',[
        'name'          =>  'artists',
        'label'         =>  'Artists',
        'url'           =>  route('autocomplete-select2artist', ['search' => '']),
        'selected'      =>  $selected_artists ?? null,
        'model'         =>  'App\\Entities\\Artist'
    ])@endcomponent
    @component('generic.form.textarea',[
        'name'     => 'lyrics',
        'label'    => 'Lyrics',
        'value'    => '',
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
              'media'         => $old_media
          ])@endcomponent
      </div>
    </div>
  </form>
@endsection

@section('javascript')
    @include('subject.media_js')
@endsection
@extends('layouts.root')

@section('content')
  <div class="row">
      <div class="col-12">
          <h4 class="d-inline-block">{{ $song->title }}</h4>
          <span class="float-right">
              <a href="{{ route('song.edit', $song) }}" class="btn btn-primary">
            		<i class="fa fa-pencil"></i> Edit
            	</a>
              <form action="{{ route('song.destroy', $song) }}" method="POST" class="d-inline-block">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-secondary">
                  <i class="fa fa-trash-o"></i> Remove
                </button>
              </form>
          </span>
      </div>
  </div>
	@component('generic.form.label', [
		'label'     =>  'Title',
		'value'     =>  $song->title
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Released',
		'value'     =>  ($song->released !== null ? date('d-m-Y',strtotime($song->released)) : '')
	])@endcomponent
	<div class="row">
		<div class="col-sm-4 col-xl-2">
			<label class="bold">Artists</label>
		</div>
		<div class="col-sm-8 col-xl-10">
      <label>
  			@foreach($song->artists as $artist)
  				<a href="{{ route('artist.show',['id' => $artist->id]) }}">{{ $artist->name }}</a>
          @if(!$loop->last)
            ,
          @endif
  			@endforeach
      </label>
		</div>
	</div>
  @if($song->lyrics->count() !== 0)
    @component('generic.form.label', [
      'label'          =>  'Lyrics',
      'value'          =>  $song->lyrics->last()->lyrics,
      'inputClass'     =>  'text-pre-line'
    ])@endcomponent
  @endif
@endsection
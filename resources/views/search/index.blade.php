@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Search</title>
@endsection

@section('content')
	<form action="{{ route('search.results') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Search</h4>
            <span class="float-right">
                <button type="submit" class="btn btn-primary">
          					<i class="fa fa-search"></i>
          					Search
        				</button>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <div class="text-center">
                @component('generic.input.checkall', [
                    'text'    => 'All',
                    'name'    => 'search_terms'
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'Artists',
                    'name'    => 'search_terms',
                    'value'   => 'artists', 
                    'checked' => array_key_exists('Artists', $selected)
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'Songs',
                    'name'    => 'search_terms',
                    'value'   => 'songs',
                    'checked' => array_key_exists('Songs', $selected)
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'Albums',
                    'name'    => 'search_terms',
                    'value'   => 'albums',
                    'checked' => array_key_exists('Albums', $selected)
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'People',
                    'name'    => 'search_terms',
                    'value'   => 'people',
                    'checked' => array_key_exists('People', $selected)
                ])@endcomponent
            </div>
        </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'search',
			'label'     =>  'Enter a search term',
			'required'  =>  true,
			'autofocus' =>  true,
      'value'     =>  $search_term,
		])@endcomponent
	</form>
  <div class="row">
    <div class="col-lg-4">
      @if(!empty($artists))
        @if($artists->count() !== 0)
          <h5 class="text-center">Artists</h5>
          <div class="list-group pb-3">
            @foreach($artists as $artist)
              <a href="{{ route('artist.show_name',array($artist,str_slug($artist->name))) }}" class="list-group-item d-block text-center">
                {{ $artist->name }}
              </a>
            @endforeach
          </div>
        @endif
      @endif
    </div>
    <div class="col-lg-4">
      @if(!empty($songs))
        @if($songs->count() !== 0)
          <h5 class="text-center">Songs</h5>
          <div class="list-group pb-3">
            @foreach($songs as $song)
              <a href="{{ route('song.show_name',array($song,str_slug($song->title))) }}" class="list-group-item d-block text-center">
                {{ $song->title }}
              </a>
            @endforeach
          </div>
        @endif
      @endif
    </div>
    <div class="col-lg-4">
      @if(!empty($people))
        @if($people->count() !== 0)
          <h5 class="text-center">People</h5>
          <div class="list-group pb-3">
            @foreach($people as $person)
              <a href="{{ route('person.show_name',array($person,str_slug($person->text))) }}" class="list-group-item d-block text-center">
                {{ $person->full_name }}</li>
              </a>
            @endforeach
          </div>
        @endif
      @endif
    </div>
  </div>
@endsection
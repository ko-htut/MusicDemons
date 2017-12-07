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
  @if($song->subject->youtube_id !== null)
    <div class="row">
      <div class="col-lg-12">
        <div class="d-block mx-auto mw-100 text-center">
          <div id="player"></div>
          <br>
          <label id="time"></label>
        </div>
       </div>
     </div>
  @endif
  <div class="card">
      <div class="card-header">
          <i class="fa fa-info"></i>
          General information
      </div>
      <div class="card-block">
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
      </div>
  </div>
  <br>
  <div class="card">
      <div class="card-header">
          <i class="fa fa-facebook"></i>
          Media
      </div>
      <div class="card-block table-responsive">
          <table class="table table-striped table-hover m-0">
              <thead>
                  <tr>
                      <th>Value</th>
                      <th class="hidden-xs-down">Medium</th>
                  </tr>
              </thead>
              <tbody>
      			      @foreach($song->subject->media as $medium)
                      <tr>
                          <td><a href="{{ $medium->value }}" target="_blank">{{ $medium->value }}</a></td>
                          <td class="hidden-xs-down">{{ $medium->medium_type->description }}</td>
                      </tr>
      			      @endforeach
              </tbody>
          </table>  
      </div>
  </div>
  @if($song->lyrics->count() !== 0)
    <br>
    <div class="card">
        <div class="card-header">
            <i class="fa fa-music"></i>
            Lyrics
            @if($song->subject->youtube_id !== null)
                <a class="btn btn-secondary pull-right" href="{{ route('song.sync',compact('song')) }}" title="Create timeline for lyrics">
                    <i class="fa fa-clock-o"></i>
                </a>
            @endif
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-md-12 text-pre-line">{{ $song->lyrics->last()->lyrics }}</div>
            </div>
        </div>
    </div>
  @endif
@endsection

@section('javascript')
        if(){
  @if($song->subject->youtube_id !== null)
    var lines = {!! json_encode(array_values($lines)) !!};
    var times = {!! $song->latest_lyrics === null ? '[]' : json_encode($song->latest_lyrics->timing) !!};
    var player;
    var timer;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          width: '640',
          videoId: "{{ $song->subject->youtube_id }}",
          events: {
            'onStateChange': onPlayerStateChange
          }
        });
      }
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {
            timer = setInterval(function(){
                var txt = lines.filter(function(line,index){
                    //return parseFloat(times[index + 1]) > player.getCurrentTime();
                    return parseFloat(times[index]) < player.getCurrentTime();
                });
                $("#time").html(txt[txt.length - 1]);
            }, 100);
        } else if (timer !== null) {
            clearInterval(timer);
        }
      }
      function stopVideo() {
        player.pauseVideo();
      }
  @endif
@endsection
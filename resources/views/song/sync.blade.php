@extends('layouts.root')

@section('title')
  <title>LyricDB - Sync {{ $song->title }}</title>
@endsection

@section('content')
	<form action="{{ route('song.syncstore',$song) }}" method="POST">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Synchronize song: {{ $song->title }}</h4>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Store synchronized lyrics
        				</button>
            </span>
        </div>
    </div>
    <div class="card fixed-bottom mr-3 card-bottom">
      <div id="player"></div>
      <div class="card-body">
        <div class="card-text">
          <label id="time" class="d-block text-center"></label>
        </div>
      </div>
    </div>
    <div class="form-group row">
			<div class="col-md-12">
          @foreach($lines as $line)
              <div class="row">
                  <div class="col-sm-2 col-xl-1">
                      <input type="text" class="form-control" name="times[]" value="{{
                          !is_array($song->lyrics->last()->timing)
                          ? ''
                          : count($song->lyrics->last()->timing) > $loop->index
                          ? $song->lyrics->last()->timing[$loop->index]
                          : ''
                      }}">
                  </div>
                  <div class="col-sm-10 col-xl-11">
                      <label class="py-6px">{{ $line }}</label>
                  </div>
              </div>
          @endforeach
      </div>
    </div>
	</form>
@endsection

@section('javascript')
    var player;
    var timer;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          width: '320',
          height: '180',
          videoId: "{{ $song->subject->youtube_id }}",
          events: {
            'onStateChange': onPlayerStateChange
          }
        });
      }
      function onPlayerStateChange(event) {
        //document.getElementById("state").innerHTML = event.data.toString();
        if (event.data == YT.PlayerState.PLAYING) {
            timer = setInterval(function(){
                $("#time").html(Math.round(player.getCurrentTime() * 10) / 10);
            }, 100);
        } else if (timer !== null) {
            clearInterval(timer);
        }
      }
      function stopVideo() {
        player.pauseVideo();
      }
@endsection
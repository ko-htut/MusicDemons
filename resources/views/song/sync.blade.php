@extends('layouts.root')

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
    <div class="row">
      <div class="col-lg-12">
        <div class="d-block mx-auto mw-100 text-center">
          <div id="player"></div>
          <br>
          <label id="time"></label>
        </div>
       </div>
     </div>
    <div class="form-group row">
			<div class="col-md-12">
          @foreach($lines as $line)
              <div class="row">
                  <div class="col-md-2">
                      <input type="text" class="form-control">
                  </div>
                  <div class="col-md-10">
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
          width: '640',
          videoId: "{{ $song->subject->youtube_id }}",
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
      function onPlayerReady(event) {
        //event.target.playVideo();
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
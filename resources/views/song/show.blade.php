@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - {{ $song->title }}</title>
@endsection

@section('description')
  <meta name="description" content="The lyrics of {{ $song->title }} and video with extra information is available on MusicDemons.">
@endsection

@section('content')
  <div class="row">
      <div class="col-12">
          <h1 class="d-inline-block">{{ $song->title }}</h1>
          <span class="float-none float-sm-right d-block d-sm-inline-block">
	            <span class="float-none float-sm-right d-block d-sm-inline-block">
                  <a href="{{ route('song.edit', $song) }}" class="btn btn-primary d-block d-sm-inline-block">
                		<i class="fa fa-pencil"></i> Edit
                	</a><!--
                  --><form action="{{ route('song.destroy', $song) }}" method="POST" class="d-block d-sm-inline-block">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-secondary btn-block d-sm-inline-block">
                      <i class="fa fa-trash-o"></i> Remove
                    </button>
                  </form>
              </span>
              @component('subject.likebuttons', [
                  'subject' => $song->subject
              ])@endcomponent
          </span>
      </div>
  </div>
  @if($song->subject->youtube_id !== null)
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="mw-100">
          <div id="player"></div>
        </div>
       </div>
     </div>
     <div class="row">
       <div class="col-md-12 text-center">
         <span class="h5 d-block" id="lyric_1"></span>
         <span class="h5 d-block" id="lyric_2"></span>
         <span class="h5 d-block" id="lyric_3"></span>
         <span class="h3 d-block" id="lyric_4"></span>
         <span class="h1 d-block" id="lyric_5"></span>
         <span class="h3 d-block" id="lyric_6"></span>
         <span class="h5 d-block" id="lyric_7"></span>
         <span class="h5 d-block" id="lyric_8"></span>
         <span class="h5 d-block" id="lyric_9"></span>
       </div>
     </div>
  @endif
  <div class="card">
      <div class="card-header">
          <i class="fa fa-info"></i>
          General information
      </div>
      <div class="card-block">
          <div class="row">
              <div class="{{ $song->subject->has_image ? 'col-md-8' : 'col-md-12' }}">
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
              @if($song->subject->has_image)
                  <div class="col-md-4">
                      <img src="{{ $song->subject->image }}" class="mw-100">
                  </div>
              @endif
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
            switch(event.data) {
                case YT.PlayerState.PLAYING:
                    // start queueing the lyric lines
                    timer = setInterval(function(){
                        var current_index = -2;
                        for(var index = 0; index < lines.length; index++) {
                            if(parseFloat(times[index]) > player.getCurrentTime()) {
                                // line "index" is still to come. So current index is index - 1.
                                current_index = index - 1;
                                break;
                            }
                        }
                        if(current_index == -2) {
                            // previous for-loop did not result in hits.
                            // this means all lines have passed.
                            current_index = lines.length - 1;
                        }
                        for(var i = 1; i < 10; i++) {
                            if( (0 <= current_index - 5 + i) & (current_index - 5 + i < lines.length) ) {
                                $("#lyric_" + i).html(lines[current_index - 5 + i]);
                            } else {
                                $("#lyric_" + i).html("&nbsp;");
                            }
                        }
                        
                        
                        // take 4 more lines
                        /*var txt = lines.filter(function(line,index){
                            return parseFloat(times[index - 4]) < player.getCurrentTime();
                        });
                        for(var i = 1; i < 10; i++) {
                            $("#lyric_" + i).html(txt[txt.length - 10 + i]);
                        }*/
                    }, 100);
                    break;
                case YT.PlayerState.ENDED:
                    // stop queueing the lyric lines
                    clearInterval(timer);
                    break;
                default:
                    // stop queueing the lyric lines
                    clearInterval(timer);
                    break;                                    
            }
        }
    @endif
    @include('subject.likebuttons_js', ['subject' => $song->subject])
@endsection
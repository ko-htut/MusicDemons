@extends('layouts.root')

@section('title')
  <title>LyricDB - {{ $artist->name }}</title>
@endsection

@section('content')        
    <div class="row">
        <div class="col-12">
            <h4 class="d-inline-block">{{ $artist->name }}</h4>
            <span class="float-none float-sm-right d-block d-sm-inline-block">
                <span class="float-none float-sm-right d-block d-sm-inline-block">
                    <a href="{{ route('artist.edit', $artist) }}" class="btn btn-primary d-block d-sm-inline-block">
                  		<i class="fa fa-pencil"></i> Edit
                  	</a>
                    <form action="{{ route('artist.destroy', $artist) }}" method="POST" class="d-block d-sm-inline-block">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-secondary btn-block d-sm-inline-block">
                        <i class="fa fa-trash-o"></i> Remove
                      </button>
                    </form>
                    @if($add_another !== null)
                      <a href="{{ route('artist.create') }}" class="btn btn-secondary d-block d-sm-inline-block">
                        <i class="fa fa-plus"></i> Add another
                      </a>
                    @endif
                </span>
                @include('subject.likebuttons', ['subject' => $artist->subject])
            </span>
        </div>
    </div>
    <br>    
    <div class="card">
        <div class="card-header">
            <i class="fa fa-info"></i>
            General information
        </div>
        <div class="card-block">
          	@component('generic.form.label', [
            		'label'     =>  'Artist name',
            		'value'     =>  $artist->name
          	])@endcomponent
          	@component('generic.form.label', [
            		'label'     =>  'Year started',
            		'value'     =>  $artist->year_started
          	])@endcomponent
          	@component('generic.form.label', [
            		'label'     =>  'Year quit',
            		'value'     =>  $artist->year_quit
          	])@endcomponent
        </div>
    </div>
    <br>
    <div class="card" id="songs">
        <div class="card-header">
            <i class="fa fa-music"></i>
            Songs
            <a class="btn btn-secondary pull-right" href="{{ route('song.createwithartist',['artist' => $artist]) }}" title="Add song for this artist">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="card-block table-responsive">
            <table class="table table-striped table-hover m-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="hidden-xs-down">Released</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artist->songs as $song)
                        <tr>
                            <td><a href="{{ route('song.show', compact('song')) }}">{{ $song->title }}</a></td>
                            <td class="hidden-xs-down">{{ $song->released !== null ? date('d/m/Y', strtotime($song->released)) : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
        			      @foreach($artist->subject->media as $medium)
                        <tr>
                            <td><a href="{{ $medium->value }}" target="_blank">{{ $medium->value }}</a></td>
                            <td class="hidden-xs-down">{{ $medium->medium_type->description }}</td>
                        </tr>
        			      @endforeach
                </tbody>
            </table>  
        </div>
    </div>
    <br>
    @if($artist->members()->wherePivot('active','=',TRUE)->count() !== 0)
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user"></i>
                Members
            </div>
            <div class="card-block table-responsive">
                <table class="table table-striped table-hover m-0">
                    <tbody>
            			      @foreach($artist->members()->wherePivot('active','=',TRUE)->get() as $member)
                            <tr>
                                <td>
                                    <a href="{{ route('person.show',compact('member')) }}">{{ $member->first_name . " " . $member->last_name }}</a>
                                </td>
                            </tr>
            			      @endforeach
                    </tbody>
                </table>        
            </div>
        </div>
        <br>
    @endif
    @if($artist->members()->wherePivot('active','=',FALSE)->count() !== 0)
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user"></i>
                Past members
            </div>
            <div class="card-block table-responsive">
                <table class="table table-striped table-hover m-0">
                    <tbody>
            			      @foreach($artist->members()->wherePivot('active','=',FALSE)->get() as $member)
                            <tr>
                                <td>
                                    <a href="{{ route('person.show',compact('member')) }}">{{ $member->first_name . " " . $member->last_name }}</a>
                                </td>
                            </tr>
            			      @endforeach
                    </tbody>
                </table>        
            </div>
        </div>
    @endif
@endsection
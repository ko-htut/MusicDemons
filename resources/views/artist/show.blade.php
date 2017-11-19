@extends('layouts.root')

@section('content')        
    <div class="row">
        <div class="col-12">
            <h4 class="d-inline-block">{{ $artist->name }}</h4>
            <span class="float-right">
                <a href="{{ route('artist.edit', $artist) }}" class="btn btn-primary">
              		<i class="fa fa-pencil"></i> Edit
              	</a>
                <form action="{{ route('artist.destroy', $artist) }}" method="POST" class="d-inline-block">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-secondary">
                    <i class="fa fa-trash-o"></i> Remove
                  </button>
                </form>
                @if($add_another !== null)
                  <a href="{{ route('artist.create') }}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i> Add another
                  </a>
                @endif
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
    <div class="card">
        <div class="card-header">
            <i class="fa fa-facebook"></i>
            Media
        </div>
        <div class="card-block">
            <table class="table table-striped table-hover">
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
    <div class="card">
        <div class="card-header">
            <i class="fa fa-user"></i>
            Members
        </div>
        <div class="card-block">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="hidden-xs-down">Joined</th>
                        <th class="hidden-xs-down">Left</th>
                    </tr>
                </thead>
                <tbody>
        			      @foreach($artist->members as $member)
                        <tr>
                            <td>
                                <a href="{{ route('person.show',['id' => $member->id]) }}">{{ $member->first_name . " " . $member->last_name }}</a>
                            </td>
                            <td class="hidden-xs-down"></td>
                            <td class="hidden-xs-down"></td>
                        </tr>
        			      @endforeach
                </tbody>
            </table>        
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <i class="fa fa-music"></i>
            Songs
            <a class="btn btn-secondary pull-right" href="{{ route('song.createwithartist',['artist' => $artist]) }}">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="card-block">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="hidden-xs-down">Released</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artist->songs as $song)
                        <tr>
                            <td><a href="{{ route('song.show', [ 'song' => $song->id ]) }}">{{ $song->title }}</a></td>
                            <td class="hidden-xs-down">{{ date('d/m/Y', strtotime($song->released)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
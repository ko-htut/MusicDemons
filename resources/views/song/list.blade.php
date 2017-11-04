@extends('layouts.root')

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All songs</h4>
          <span class="float-right">
            	<a href="{{ route('song.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add song
            	</a>
          </span>
      </div>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th class="hidden-xs-down">Released</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($songs as $song)
        <tr>
          <td>
            <a href="{{ route('song.show',$song->id) }}">
              {{ $song->title }}
            </a>
          </td>
          <td class="hidden-xs-down">
              @if($song->released !== null)
                  {{ date('d-m-Y',strtotime($song->released)) }}
              @endif
          </td>
          <td class="trash">
            <form action="{{ route('song.destroy',$song->id) }}" method="POST" class="d-inline-block">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-warning" title="Remove song">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
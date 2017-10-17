@extends('layouts.root')

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All artists</h4>
          <span class="float-right">
            	<a href="{{ route('artist.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add artist
            	</a>
          </span>
      </div>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th class="hidden-xs-down">Year started</th>
        <th class="hidden-xs-down">Year quit</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($artists as $artist)
        <tr>
          <td>
            <a href="{{ route('artist.show',$artist->id) }}">
              {{ $artist->name }}
            </a>
          </td>
          <td class="hidden-xs-down">{{ $artist->year_started }}</td>
          <td class="hidden-xs-down">{{ $artist->year_quit }}</td>
          <td class="trash">
            <form action="{{ route('artist.destroy',$artist->id) }}" method="POST" class="d-inline-block">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-warning" title="Remove artist">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
@extends('layouts.root')

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All mediatypes</h4>
          <span class="float-right">
            	<a href="{{ route('mediumtypes.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add medium
            	</a>
          </span>
      </div>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th></th>
        <th>Description</th>
        <th>Base URL</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($media_types as $medium)
        <tr>
          <td>
            <img src="{{ $medium->icon_url }}" width="16" height="16">
          </td>
          <td>
            <a href="{{ route('mediumtypes.show',$medium->id) }}">
              {{ $medium->description }}
            </a>
          </td>
          <td>{{ $medium->base_url }}</td>
          <td class="trash">
            <form action="{{ route('mediumtypes.destroy',$medium->id) }}" method="POST" class="d-inline-block">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-warning" title="Remove medium type">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
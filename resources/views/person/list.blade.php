@extends('layouts.root')

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All people</h4>
          <span class="float-right">
            	<a href="{{ route('person.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add person
            	</a>
          </span>
      </div>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th class="hidden-xs-down">Born</th>
        <th class="hidden-xs-down">Died</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($people as $person)
        <tr>
          <td>
            <a href="{{ route('person.show',$person->id) }}">
              {{ $person->first_name . " " . $person->last_name }}
            </a>
          </td>
          <td class="hidden-xs-down">
              @if($person->born !== null)
                  {{ date('d-m-Y',strtotime($person->born)) }}
                  @if($person->birth_place !== null)
                      <span class="hidden-md-down">{{ "(" . $person->birth_place . ")" }}</span>
                  @endif
              @endif
          </td>
          <td class="hidden-xs-down">
            @if($person->died !== null)
              {{ date('d-m-Y',strtotime($person->died)) }}
            @endif
          </td>
          <td class="trash">
            <form action="{{ route('person.destroy',$person->id) }}" method="POST" class="d-inline-block">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-warning" title="Remove person">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
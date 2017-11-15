@extends('layouts.root')

@section('content')
  <div class="row">
      <div class="col-12">
          <h4 class="d-inline-block">{{ $person->first_name . " " . $person->last_name }}</h4>
          <span class="float-right">
              <a href="{{ route('person.edit', $person) }}" class="btn btn-primary">
            		<i class="fa fa-pencil"></i> Edit
            	</a>
              <form action="{{ route('person.destroy', $person) }}" method="POST" class="d-inline-block">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-secondary">
                  <i class="fa fa-trash-o"></i> Remove
                </button>
              </form>
          </span>
      </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-info"></i> General information
    </div>
    <div class="card-block">
    	@component('generic.form.label', [
    		'label'     =>  'First name',
    		'value'     =>  $person->first_name
    	])@endcomponent
    	@component('generic.form.label', [
    		'label'     =>  'Last name',
    		'value'     =>  $person->last_name
    	])@endcomponent
      @if($person->nickname !== null)
      	@component('generic.form.label', [
      		'label'     =>  'Nickname',
      		'value'     =>  $person->nickname
      	])@endcomponent
      @endif
    	@component('generic.form.label', [
    		'label'     =>  'Birth day',
    		'value'     =>  ($person->born !== null ? date('d-m-Y',strtotime($person->born)) : '')
    	])@endcomponent
    	@component('generic.form.label', [
    		'label'     =>  'Birth place',
    		'value'     =>  $person->birth_place
    	])@endcomponent
    	@component('generic.form.label', [
    		'label'     =>  'Died',
    		'value'     =>  ($person->died !== null ? date('d-m-Y',strtotime($person->died)) : '')
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
      			      @foreach($person->subject->media as $medium)
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
      <i class="fa fa-user-circle"></i> Member of
    </div>
    <div class="card-block">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Artist name</th>
            <th class="hidden-xs-down">Joined</th>
            <th class="hidden-xs-down">Left</th>
          </tr>
        </thead>
        <tbody>
          @foreach($person->artist as $artist)
  			    <tr>
              <td>
                <a href="{{ route('artist.show',['id' => $artist->id]) }}">{{ $artist->name }}</a>
              </td>
              <td class="hidden-xs-down"></td>
              <td class="hidden-xs-down"></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    
    </div>
  </div>
@endsection
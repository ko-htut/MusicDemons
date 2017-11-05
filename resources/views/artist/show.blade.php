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
          </span>
      </div>
  </div>
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
	<div class="row">
		<div class="col-sm-4 col-xl-2">
			<label class="bold">Members</label>
		</div>
		<div class="col-sm-8 col-xl-10">
      <label>
  			@foreach($artist->members as $member)
  				<a href="{{ route('person.show',['id' => $member->id]) }}">{{ $member->first_name . " " . $member->last_name }}</a>
          @if(!$loop->last)
            ,
          @endif
  			@endforeach
       </label>
		</div>
	</div>
@endsection
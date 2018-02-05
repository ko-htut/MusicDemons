@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Medium-type: {{ $mediumtype->description }}</title>
@endsection

@section('content')
  <div class="row">
      <div class="col-12">
          <h4 class="d-inline-block">{{ $mediumtype->description }}</h4>
          <span class="float-right">
              <a href="{{ route('mediumtypes.edit', $mediumtype) }}" class="btn btn-primary">
            		<i class="fa fa-pencil"></i> Edit
            	</a>
              <form action="{{ route('mediumtypes.destroy', $mediumtype) }}" method="POST" class="d-inline-block">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-secondary">
                  <i class="fa fa-trash-o"></i> Remove
                </button>
              </form>
              @if($add_another !== null)
                <a href="{{ route('mediumtypes.create') }}" class="btn btn-secondary">
                  <i class="fa fa-plus"></i> Add another
                </a>
              @endif
          </span>
      </div>
  </div>
	@component('generic.form.label', [
		'label'     =>  'Description',
		'value'     =>  $mediumtype->description
	])@endcomponent
	@component('generic.form.label', [
		'label'     =>  'Base URL',
		'value'     =>  $mediumtype->base_url
	])@endcomponent
@endsection
@extends('layouts.root')

@section('content')
	<form action="{{ route('artist.update',$artist->id) }}" method="POST">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Edit artist: {{ $artist->name }}</h4>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update artist
        				</button>
            </span>
        </div>
    </div>
		@component('generic.form.text', [
			'name'      =>  'name',
			'label'     =>  'Artist name',
      'value'     =>  $artist->name,
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_started',
			'label'     =>  'Year started',
      'value'     =>  $artist->year_started,
			'required'  =>  true
		])@endcomponent
		@component('generic.form.text', [
			'name'      =>  'year_quit',
			'label'     =>  'Year quit',
      'value'     =>  $artist->year_quit,
			'required'  =>  false
		])@endcomponent
		<div class="form-group row">
			<label for="members" class="col-sm-4 col-xl-2">Members</label>
			<div class="col-sm-8 col-xl-10">
				<select class="form-control select2" name="members[]" id="members" data-placeholder="Members" data-url="{{ route('autocomplete-select2person', ['search' => '']) }}" data-selected="{!! str_replace("\"", "'", json_encode($selected_members)) !!}" multiple>
				</select>
			</div>
		</div>
    <div class="form-group row">
      <label class="col-sm-4 col-xl-2">Media</label>
      <div class="col-sm-8 col-xl-10">
          @component('subject.media',[
              'medium_types'  => $medium_types,
              'media'         => $artist->subject->media
          ])@endcomponent
      </div>
    </div>
	</form>
@endsection

@section('javascript')
    @include('subject.media_js')
@endsection
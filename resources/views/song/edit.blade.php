@extends('layouts.root')

@section('content')
	<form action="{{ route('song.update',$song->id) }}" method="POST">
		{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Edit song: {{ $song->title }}</h4>
            <span class="float-right">
        				<button type="submit" class="btn btn-primary">
        					<i class="fa fa-save"></i>
        					Update song
        				</button>
            </span>
        </div>
    </div>
    @component('generic.form.text',[
        'name'      =>  'title',
        'label'     =>  'Title',
        'value'     =>  $song->title,
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'released',
        'label'     =>  'Released',
        'value'     =>  $song->released
    ])@endcomponent
		<div class="form-group row">
			<label for="artists" class="col-sm-4 col-xl-2">Artists</label>
			<div class="col-sm-8 col-xl-10">
				<select class="form-control select2" name="artists[]" id="artists" data-placeholder="Artists" data-url="{{ route('autocomplete-select2artist', ['search' => '']) }}" data-selected="{!! str_replace("\"", "'", json_encode($selected_artists)) !!}" multiple>
				</select>
			</div>
		</div>
	</form>
@endsection
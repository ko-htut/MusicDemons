@extends('layouts.root')

@section('content')
	<form action="{{ route('song.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-12">
				<h4 class="d-inline-block">Create song</h4>
				<span class="float-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create song
					</button>
				</span>
			</div>
		</div>
    @component('generic.form.text',[
        'name'      =>  'title',
        'label'     =>  'Title',
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'released',
        'label'     =>  'Released'
    ])@endcomponent
    <div class="form-group row">
        <label for="artists" class="col-sm-4 col-xl-2">Artists</label>
        <div class="col-sm-8 col-xl-10">
            <select class="form-control select2" name="artists[]" id="artists" data-placeholder="Artists" data-url="{{ route('autocomplete-select2artist', ['search' => '']) }}" multiple>
            </select>
        </div>
    </div>
    <div class="form-group row">
      <label for="lyrics" class="col-sm-4 col-xl-2">Lyrics</label>
			<div class="col-sm-8 col-xl-10">
        <textarea class="form-control" rows="15" name="lyrics" id="lyrics"></textarea>
      </div>
    </div>
  </form>
@endsection
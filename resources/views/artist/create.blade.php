@extends('layouts.root')

@section('content')
  {{--
    <div id="app">
      <artist-create>
      </artist-create>
    </div>
  --}}
	<form action="{{ route('artist.store') }}" method="POST">
    {{ csrf_field() }}
		<div class="form-group row">
			<div class="col-12">
				<h4 class="d-inline-block">Create artist</h4>
				<span class="float-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create artist
					</button>
				</span>
			</div>
		</div>
    @component('generic.form.text',[
        'name'      =>  'name',
        'label'     =>  'Artist name',
        'required'  =>  true,
        'autofocus' =>  true
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'year_started',
        'label'     =>  'Year started',
        'required'  =>  true
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'year_quit',
        'label'     =>  'Year quit'
    ])@endcomponent
		<div class="form-group row">
			<label for="members" class="col-sm-4 col-xl-2">Members</label>
			<div class="col-sm-8 col-xl-10">
				<select class="form-control select2" name="members[]" id="members" data-placeholder="Members" data-url="{{ route('autocomplete-select2person', ['search' => '']) }}" multiple>
				</select>
			</div>
		</div>
  </form>
@endsection
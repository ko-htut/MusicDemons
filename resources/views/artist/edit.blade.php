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
          <div class="row" id="button-row">
              <div class="col-md-12">
                  <button type="button" class="btn btn-primary w-100" id="btnCreateEmail" ng-click="vm.createEmail()">
                      <i class="fa fa-plus"></i>
                      Add
                  </button>
              </div>
          </div>
      </div>
    </div>
	</form>
@endsection

@section('javascript')
    $(document).ready(function(){
        $("#btnCreateEmail").click(function(){
            $(`<div class="row">
                   <div class="col-md-12">
                       <div class="row">
                           <div class="col-md-6 ml-xl-0">
                               <select class="form-control">
                                   @foreach($media as $medium)
                                       <option>{{ $medium->description }}</option>
                                   @endforeach
                               </select>
                           </div>
                           <div class="col-md-6 mr-0">
                               <input type="text" class="form-control">
                           </div>
                       </div>
                   </div>
               </div>`
            ).insertBefore("#button-row");
        });
    });
@endsection
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
    <div class="form-group row">
      <label class="col-sm-4 col-xl-2">Media</label>
      <div class="col-sm-8 col-xl-10">
          @component('subject.media',[
              'medium_types'  => $medium_types
          ])@endcomponent
      </div>
    </div>
  </form>
  <div class="card" id="ArtistExistPanel" style="display:none">
    <div class="card-header">
      These artists already exist
    </div>
    <div class="card-block">
      <p class="card-text">The artist you are trying to add is probably already present in the database. Please check before adding this artist.</p>
      <div class="d-block" id="artists">
      
      </div>
    </div>
  </div>
@endsection

@section('javascript')
    @include('subject.media_js')
    $(document).ready(function(){
        $('#name').on('input', function(){
            if($('#name').val() !== ""){
                $.ajax({
                    url: "{{ route('api-autocomplete-rawartist') }}",
                    method: "post",
                    data: {
                        name: $('#name').val()
                    },
                    success: function(response){
                        if(response.length === 0){
                            $("#ArtistExistPanel").css('display','none');
                        } else {
                            $("#artists > a").remove();
                            $(response).each(function(){
                                $('<a class="btn btn-primary" href="' + this.url + '" target="_blank"><i class="fa fa-user"></i> ' + this.name + '</a>')
                                    .appendTo($("#artists"));
                            });
                            $("#ArtistExistPanel").css('display','flex');
                        }
                    },
                    error: function(){
                        $("#ArtistExistPanel").css('display','none');
                    }
                });
            }
        });
    });
@endsection
@extends('layouts.root')

@section('content')
  {{--
    <div id="app">
      <artist-create>
      </artist-create>
    </div>
  --}}
  <div class="modal fade" id="AddPersonModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new person</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
						<form>
              <div class="form-group row">
                <label for="first_name" class="col-sm-4 col-xl-2">First name</label>
                <div class="col-sm-8 col-xl-10">
                  <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="" required="" autofocus="">
                </div>
              </div>
              <div class="form-group row">
                <label for="last_name" class="col-sm-4 col-xl-2">Last name</label>
                <div class="col-sm-8 col-xl-10">
                  <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="" required="">
                </div>
              </div>
              <div class="form-group row">
                <label for="nickname" class="col-sm-4 col-xl-2">Nickname</label>
                <div class="col-sm-8 col-xl-10">
                  <input type="text" class="form-control" name="nickname" id="nickname" value="" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label for="born" class="col-sm-4 col-xl-2">Birth day</label>
                <div class="col-sm-8 col-xl-10">
                  <input type="date" class="form-control" name="born" id="born" value="" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label for="birth_place" class="col-sm-4 col-xl-2">Birth place</label>
                <div class="col-sm-8 col-xl-10">
                  <input type="text" class="form-control" name="birth_place" id="birth_place" value="" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label for="died" class="col-sm-4 col-xl-2">Died</label>
                <div class="col-sm-8 col-xl-10">
                  <input type="date" class="form-control" name="died" id="died" value="" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-xl-2">Media</label>
                <div class="col-sm-8 col-xl-10">
                  <div class="row m-0 medium-button-row" id="button-row">
                    <div class="col-md-12 px-0">
                      <button type="button" class="btn btn-primary w-100 btn-create-medium" id="btnCreatePersonMedium">
                        <i class="fa fa-plus"></i>
                        Add
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
     	    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Close
          </button>
          <button type="button" class="btn btn-primary">
            <i class="fa fa-save"></i>
            Save person
          </button>
        </div>
      </div>
    </div>
  </div>
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
    @component('generic.form.select2',[
        'name'          =>  'members',
        'label'         =>  'Current members',
        'url'           =>  route('autocomplete-select2person', ['search' => '']),
        'model'         =>  'App\\Entities\\Person'
    ])@endcomponent
    @component('generic.form.select2',[
        'name'          =>  'past_members',
        'label'         =>  'Past members',
        'url'           =>  route('autocomplete-select2person', ['search' => '']),
        'model'         =>  'App\\Entities\\Person'
    ])@endcomponent
    <div class="form-group row">
      <label class="col-sm-4 col-xl-2">Media</label>
      <div class="col-sm-8 col-xl-10">
          @component('subject.media',[
              'medium_types'  => $medium_types,
              'media'         => $old_media
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
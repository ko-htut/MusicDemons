@extends('layouts.root')

@section('title')
  <title>LyricDB - Add Person</title>
@endsection

@section('content')
	<form action="{{ route('person.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-12">
				<h4 class="d-inline-block">Create person</h4>
				<span class="float-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save"></i>
						Create person
					</button>
				</span>
			</div>
		</div>
    @component('generic.form.text',[
        'name'          =>  'first_name',
        'label'         =>  'First name',
        'required'      =>  true,
        'autofocus'     =>  true,
        'autocomplete'  =>  false
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'last_name',
        'label'     =>  'Last name',
        'required'  =>  true
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'nickname',
        'label'     =>  'Nickname'
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'born',
        'label'     =>  'Birth day'
    ])@endcomponent
    @component('generic.form.text',[
        'name'      =>  'birth_place',
        'label'     =>  'Birth place'
    ])@endcomponent
    @component('generic.form.date',[
        'name'      =>  'died',
        'label'     =>  'Died'
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
  <div class="card" id="PersonExistPanel" style="display:none">
    <div class="card-header">
      These people already exist
    </div>
    <div class="card-block">
      <p class="card-text">The person you are trying to add is probably already present in the database. Please check before adding this person.</p>
      <div class="d-block" id="people">
      
      </div>
    </div>
  </div>
@endsection

@section('javascript')
    @include('subject.media_js')
    $(document).ready(function(){
        $('#first_name,#last_name').on('input', function(){
            if(($('#first_name').val() !== "") && ($('#last_name').val() !== "")){
                $.ajax({
                    url: "{{ route('api-autocomplete-rawperson') }}",
                    method: "post",
                    data: {
                        first_name: $('#first_name').val(),
                        last_name: $('#last_name').val()
                    },
                    success: function(response){
                        if(response.length === 0){
                            $("#PersonExistPanel").css('display','none');
                        } else {
                            $("#people > a").remove();
                            $(response).each(function(){
                                $('<a class="btn btn-primary" href="' + this.url + '" target="_blank"><i class="fa fa-user"></i> ' + this.first_name + ' ' + this.last_name + '</a>')
                                    .appendTo($("#people"));
                            });
                            $("#PersonExistPanel").css('display','flex');
                        }
                    },
                    error: function(){
                        $("#PersonExistPanel").css('display','none');
                    }
                });
            }
        });
    });
@endsection
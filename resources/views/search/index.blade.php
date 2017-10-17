@extends('layouts.root')

@section('content')
	<form action="{{ route('search-search') }}" method="POST">
    <div class="form-group row">
        <div class="col-12">
            <h4 class="d-inline-block">Search</h4>
            <span class="float-right">
                <button type="submit" class="btn btn-primary">
          					<i class="fa fa-search"></i>
          					Search
        				</button>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <div class="text-center">
                <!--<button type="button" class="btn {{ count($selected) === 4 ? 'btn-primary' : 'btn-secondary' }} search-btn search-btn-all">All</button>
                <button type="button" class="btn {{ array_key_exists('Artists', $selected) ? 'btn-primary' : 'btn-secondary' }} search-btn">Artists</button>
                <button type="button" class="btn {{ array_key_exists('Songs', $selected) ? 'btn-primary' : 'btn-secondary' }} search-btn">Songs</button>
                <button type="button" class="btn {{ array_key_exists('Albums', $selected) ? 'btn-primary' : 'btn-secondary' }} search-btn">Albums</button>
                <button type="button" class="btn {{ array_key_exists('People', $selected) ? 'btn-primary' : 'btn-secondary' }} search-btn">People</button>-->
                
                @component('generic.input.checkall', [
                    'text'    => 'All',
                    'name'    => 'search_terms'
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'Artists',
                    'name'    => 'search_terms',
                    'value'   => 'artists', 
                    'checked' => array_key_exists('Artists', $selected)
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'Songs',
                    'name'    => 'search_terms',
                    'value'   => 'songs',
                    'checked' => array_key_exists('Songs', $selected)
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'Albums',
                    'name'    => 'search_terms',
                    'value'   => 'albums',
                    'checked' => array_key_exists('Albums', $selected)
                ])@endcomponent
                @component('generic.input.checkbutton', [
                    'text'    => 'People',
                    'name'    => 'search_terms',
                    'value'   => 'people',
                    'checked' => array_key_exists('People', $selected)
                ])@endcomponent
            </div>
        </div>
    </div>
		{{ csrf_field() }}
		@component('generic.form.text', [
			'name'      =>  'search',
			'label'     =>  'Enter a search term',
			'required'  =>  true,
			'autofocus' =>  true
		])@endcomponent
	</form>
@endsection

@section('javascript')
  <script type="text/javascript">
    $(document).ready(function(){
        /*$(".search-btn-all").click(function(event){
            if($(event.currentTarget).hasClass('btn-primary')){
                $(".search-btn").removeClass('btn-primary').addClass('btn-secondary');
            } else {
                $(".search-btn").removeClass('btn-secondary').addClass('btn-primary');
            }
        });*/
    });
  </script>
@endsection
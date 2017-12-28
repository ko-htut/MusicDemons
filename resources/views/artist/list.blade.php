@extends('layouts.root')

@section('title')
  <title>LyricDB - Artists</title>
@endsection

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All artists</h4>
          <span class="float-right">
            	<a href="{{ route('artist.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add artist
            	</a>
          </span>
      </div>
  </div>
  <table id="artistsTable" class="table table-striped table-hover w-100" cellspacing="0">
    <thead>
      <tr>
        <th>Name</th>
        <th class="hidden-xs-down">Year started</th>
        <th class="hidden-xs-down">Year quit</th>
      </tr>
    </thead>
  </table>
@endsection

@section('javascript')
  $(document).ready(function(){
    var artistsTable = $('#artistsTable').DataTable({
      processing: true,
      serverSide: true,
      pageLength: {{ $count }},
      displayStart: {{ ($page - 1) * $count }},
      ajax: {
        url: "{{ route('api-v1-artist.datatables') }}",
        type: "POST"
      },
      columns: [{
        data: "name",
        name: "name",
        fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
          $(nTd).html("<a href=\"/artist/" + oData.id + "\">" + oData.text + "</a>");
        }
      },{
        data: "year_started",
        name: "year_started",
        fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
          $(nTd).addClass("hidden-xs-down");
        }
      },{
        data: "year_quit",
        name: "year_quit",
        fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
          $(nTd).addClass("hidden-xs-down");
        }
      }],
      language: {
        paginate: {
          previous: "&laquo;",
          next: "&raquo;",
        },
      },
    });
    var route = "{{ route('artist.page', array('count' => ':count', 'page' => ':page')) }}";
    $('#artistsTable').on('page.dt length.dt',function(event,settings){
        var info = artistsTable.page.info();
        var pagedUrl = route.replace(':count', info.length).replace(':page',info.page+1);
        window.history.pushState({
            html: "",
            pageTitle: ""
        },"",pagedUrl);
    });
  });
@endsection
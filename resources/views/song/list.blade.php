@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - Songs</title>
@endsection

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All songs</h4>
          <span class="float-right">
            	<a href="{{ route('song.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add song
            	</a>
          </span>
      </div>
  </div>
  <table id="songsTable" class="table table-striped table-hover w-100" cellspacing="0">
    <thead>
      <tr>
        <th>Title</th>
        <th class="hidden-xs-down">Artists</th>
        <th class="hidden-xs-down">Released</th>
      </tr>
    </thead>
  </table>
@endsection

@section('javascript')
  $(document).ready(function(){
    var songsTable = $("#songsTable").DataTable({
      processing: true,
      serverSide: true,
      pageLength: {{ $count }},
      displayStart: {{ ($page - 1) * $count }},
      ajax: {
        url: "{{ route('api-v1-song.datatables') }}",
        type: "POST"
      },
      columns: [{
        data: "title",
        name: "title",
        fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
          $(nTd).html("<a href=\"/song/" + oData.id + "\">" + oData.text + "</a>");
        }
      },{
        data: "artists",
        sortable: false,
        searchable: false,
        fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
          var result = "";
          $(sData).each(function(index, artist){
            result += "<a href=\"/artist/" + artist.id + "\">" + artist.text + "</a>";
            if(index != sData.length - 1){
              result += ", ";
            }
          });
          $(nTd).addClass("hidden-xs-down")
                .html(result);
        }
      },{
        data: "released",
        name: "released",
        fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
          $(nTd).addClass("hidden-xs-down");
        },
        render: function(data,type,row){
          if ( type !== 'display' && type !== 'filter' ) {
            return data;
          } else if(data == null){
            return "";
          } else {
            return moment(data).format("DD/MM/YYYY");
          }
        }
      }],
      language: {
        paginate: {
          previous: "&laquo;",
          next: "&raquo;",
        },
      },
    });
    
    var route = "{{ route('song.page', array('count' => ':count', 'page' => ':page')) }}";
    $('#songsTable').on('page.dt length.dt',function(event,settings){
        var info = songsTable.page.info();
        var pagedUrl = route.replace(':count', info.length).replace(':page',info.page+1);
        window.history.pushState({
            html: "",
            pageTitle: ""
        },"", pagedUrl);
    });
  });
@endsection
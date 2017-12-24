@extends('layouts.root')

@section('title')
  <title>LyricDB - Songs</title>
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
  });
@endsection
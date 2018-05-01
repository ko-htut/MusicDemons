@extends('layouts.root')

@section('title')
  <title>{{ config('app.name', 'Laravel') }} - People</title>
@endsection

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h1 class="d-inline-block">All people</h1>
          <span class="float-right">
            	<a href="{{ route('person.create') }}" class="btn btn-primary">
            		<i class="fa fa-plus"></i> Add person
            	</a>
          </span>
      </div>
  </div>
  <table id="peopleTable" class="table table-striped table-bordered table-hover w-100"  cellspacing="0">
    <thead>
      <tr>
        <th>Name</th>
        <th class="hidden-xs-down">Born</th>
        <th class="hidden-xs-down">Died</th>
      </tr>
    </thead>
  </table>
@endsection

@section('javascript')
  // https://github.com/DataTables/DataTablesSrc/blob/master/js/ext/ext.classes.js#L7
  $(document).ready(function(){
    var peopleTable = $("#peopleTable").DataTable({
      processing: true,
      serverSide: true,
      pageLength: {{ $count }},
      displayStart: {{ ($page - 1) * $count }},
      ajax: {
        url:  "{{ route('api-v1-person.datatables') }}",
        type: "POST",
        data: function(data){
            data.filter_search = data.search.value;
        }
      },
      columns: [{
          data: "text",
          name: "first_name",
          fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
            $(nTd).html("<a href=\"/person/" + oData.id + "\">" + oData.text + "</a>");
          }
        },{
          data: "born",
          name: "Born",
          render: function(data,type,row){
            if ( type !== 'display' && type !== 'filter' ) {
              return data;
            } else if(data == null){
              return "";
            } else {
              return moment(data).format("DD/MM/YYYY");
            }
          },
          fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
            $(nTd).addClass("hidden-xs-down");
          },
        },{
          data: "died",
          name: "Died",
          render: function(data,type,row){
            if ( type !== 'display' && type !== 'filter' ) {
              return data;
            } else if(data == null){
              return "";
            } else {
              return moment(data).format("DD/MM/YYYY");
            }
          },
          fnCreatedCell: function(nTd, sData, oData, iRow, iCol){
            $(nTd).addClass("hidden-xs-down");
          },
        }
      ],
      language: {
        paginate: {
          previous: "&laquo;",
          next: "&raquo;",
        },
      },
    });
    var route = "{{ route('person.page', array('count' => ':count', 'page' => ':page')) }}";
    $('#peopleTable').on('page.dt length.dt',function(event,settings){
        var info = peopleTable.page.info();
        var pagedUrl = route.replace(':count', info.length).replace(':page',info.page+1);
        window.history.pushState({
            html: "",
            pageTitle: ""
        },"",pagedUrl);
    });
  });
@endsection
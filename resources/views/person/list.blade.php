@extends('layouts.root')

@section('title')
  <title>LyricDB - People</title>
@endsection

@section('content')
  <div class="form-group row">
      <div class="col-12">
          <h4 class="d-inline-block">All people</h4>
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
        <th></th>
      </tr>
    </thead>
  </table>
@endsection

@section('javascript')
  // https://github.com/DataTables/DataTablesSrc/blob/master/js/ext/ext.classes.js#L7
  $(document).ready(function(){
    $("#peopleTable").DataTable({
      processing: true,
      //serverSide: true,
      ajax: {
        url:  "{{ route('api-v1-person.datatables') }}",
        type: "POST"
      },
      columns: [{
          data: "text",
          name: "Name",
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
          }
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
          }
        }
      ],
      /*buttons: {
        dom: {
          button: {
            tag: 'button',
            className: 'btn btn-default'
          },
          buttonLiner: {
            tag: 'button',
            className: 'btn btn-default'
          }
        }
      },*/
      /*classes: {
        sPageButton: 'page-link d-inline-block',
	      sPageButtonActive: 'active',
	      sPageButtonDisabled: 'disabled',
      },*/
      language: {
        paginate: {
          previous: "&laquo;",
          next: "&raquo;",
        },
      },
    });
  });
@endsection
@extends('layouts.app')
@section('pageTitle',$viewData['pageTitle'])
@section('contentHeaderTitle',$viewData['contentHeaderTitle'])
@section('content')
    @include('layouts.headers.cards') {{-- to be edited in club--}}
@if(session()->get('success'))
<div class="alert alert-success">
  {{ session()->get('success') }}
</div><br />
@endif

<a class='btn btn-primary mb-3' href='{{route('accounting.dailyrecords.create',$viewData['type'])}}'><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.add')}}</a>

<div class="table-responsive-lg">
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>{{__('accounting.date')}}</th>
            <th>{{__('accounting.description')}}</th>
            <th>{{__('accounting.credit')}}</th>
            <th>{{__('accounting.dept')}}</th>
            <th>{{__('accounting.total')}}</th>
            <th class='p-2'><i class="fa fa-cogs" aria-hidden="true"></i></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

<script type="text/javascript">
$(function () {

var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('accounting.dailyrecords.index',$viewData['type']) }}",
    columns: [
        {data: 'date', name: 'date'},
        {data: 'excerpt', name: 'description'},
        {data: 'credit', name: 'credit'},
        {data: 'dept', name: 'dept'},
        {data: 'total', name: 'total'},
        {data: "id" , render : function ( data, type, row, meta ) {
              return type === 'display'  ?
              '<a href="{{route('accounting.dailyrecords.print')}}/'+data+'" class="btn btn-primary p-2 m-1" ><i class="fa fa-print" aria-hidden="true"></i></a><a href="{{route('accounting.dailyrecords.preview')}}/'+data+'" class="btn btn-primary p-2 m-1"  target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="{{route('accounting.dailyrecords.edit',$viewData["type"])}}/'+data+'" class="btn btn-primary p-2 m-1" ><i class="fa fa-edit" aria-hidden="true"></i></a><a onclick="confirmDelete('+data+')" class="btn btn-danger p-2 m-1" ><i class="fa fa-trash" aria-hidden="true"></i></a>' :
                data;
            }},
            ]
});

});

function confirmDelete(id)
{
    Swal.fire({
  title: '{{__('accounting.dailyrecords.deleteWarningTitle')}}',
  text: '{{__('accounting.dailyrecords.deleteWarningText')}}',
  icon: 'warning',
  showDenyButton: true,
  confirmButtonText: '{{__('accounting.yes')}}',
  denyButtonText: '{{__('accounting.no')}}',
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace("{{route('accounting.dailyrecords.destroy',$viewData['type'])}}/"+id);
            }else{
                return false;
            }
})


}

</script>




@endsection

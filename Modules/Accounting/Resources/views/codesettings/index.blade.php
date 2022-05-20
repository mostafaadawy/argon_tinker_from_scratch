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

<a class='btn btn-primary mb-3' href='{{route('accounting.codesettings.create',$viewData['type'])}}'><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.add')}}</a>

<div class="table-responsive-lg">
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>{{__('accounting.code')}}</th>
            <th>{{__('accounting.name')}}</th>
            <th>{{__('accounting.isMain')}}</th>
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
    ajax: "{{ route('accounting.codesettings.index',$viewData['type']) }}",
    columns: [
        {data: 'code', name: 'code'},
        {data: 'breadcrumb', name: 'breadcrumb'},
        {data: "is_main" , render : function ( data, type, row, meta ) {
              return type === 'display'  ?
                data === '1'?'{{__("accounting.yes")}}': '{{__("accounting.no")}}' :
                data;
            }},
        {data: "id" , render : function ( data, type, row, meta ) {
              return type === 'display'  ?
                '<a onclick="confirmDelete('+data+')" class="btn btn-danger p-2" ><i class="fa fa-trash" aria-hidden="true"></i></a>' :
                data;
            }},
            ]
});

});

function confirmDelete(id)
{
    Swal.fire({
  title: '{{__('accounting.codesettings.deleteWarningTitle')}}',
  text: '{{__('accounting.codesettings.deleteWarningText')}}',
  icon: 'warning',
  showDenyButton: true,
  confirmButtonText: '{{__('accounting.yes')}}',
  denyButtonText: '{{__('accounting.no')}}',
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace("{{route('accounting.codesettings.destroy',$viewData['type'])}}/"+id);
            }else{
                return false;
            }
})


}

</script>




@endsection

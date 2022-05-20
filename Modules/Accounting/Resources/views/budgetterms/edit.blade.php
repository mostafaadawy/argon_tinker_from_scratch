@extends('layouts.app')
@section('pageTitle',$viewData['pageTitle'])
@section('contentHeaderTitle',$viewData['contentHeaderTitle'])
@section('content')
    @include('layouts.headers.cards') {{-- to be edited in club--}}
<script>
    var exclusions=[[],[]];
</script>

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
@endif

@if(session()->get('success'))
<div class="alert alert-success">
  {{ session()->get('success') }}
</div><br />
@endif

<form method="post" action="{{ route('accounting.budgetterms.update',[$viewData['type'],$viewData['term']['id']]) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-2">
        <label for="name">{{__('accounting.name')}}</label>
        <input type="text" class="form-control" name="name" maxlength="120" placeholder="{{__('accounting.enterName')}}" value="{{$viewData['term']['name']}}" required/>
    </div>



    <label for="codeSearch">{{__('accounting.codes')}}</label>


<div class='row'>
    <div class="form-group col-6 mb-2">
        <input class="form-control"  id="codeSearch"  onkeyup="searchCodes(this.value);"  name='CodeSearch' placeholder="{{__('accounting.typeToSearch')}}">

    </div>

    <div class="form-group col-6 mb-2">
        <select class="form-control"  id="codes" name='codes[]'  onchange="searchCodes(document.querySelector('#codeSearch').value)" multiple>
            <option value=""  disabled>{{__('accounting.searchAndSelect')}}</option>
        </select>
    </div>
</div>

    <button type="submit" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> {{__('accounting.submit')}}</button>

</form>

<div class="table-responsive">

<table id='datatable' class='table text-light text-center bg-dark rounded'>
                    <thead>
                        <tr>
                            <th>{{__('accounting.code')}}</th>
                            <th>{{__('accounting.name')}}</th>
                            <th><i class="fa fa-cogs" aria-hidden="true"></i></th>

                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($viewData['items'] as $item)
                                <tr>
                                    <td>{{$item->code['code']}}</td>
                                    <td>{{$item->code['breadcrumb']}}</td>
                                    <td><a href="{{route('accounting.budgetterms.destroyItem',[$viewData['type'],$viewData['term']['id'],$item['id']])}}" onclick="confirm('{{__('accounting.confirmDelete')}}')" class='btn btn-danger p-2' ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
</div>

<script>

                      $('#datatable').DataTable(
                          {
                            "columnDefs": [
                                { "orderable": false, "targets": 2 }
                            ],
                            "order": [[ 0, "asc" ]]
                          }
                      );

                  </script>




</div>
</div>

<script>
function searchCodes(key)
{
    makeExclusions();

    if(key=='')
    {
        key='0000000000';
    }

    $.ajax({
	type: "POST",
    dataType: 'json',
	url: "{{route('accounting.budgetterms.ajax',[$viewData['type'],'codeSearch'])}}",
	data:"_token={{csrf_token()}}&key="+key+"&exclude="+JSON.stringify(exclusions[1]),
	success: function(response){

        var codeSelector=document.querySelector('#codes');
        codeSelector.innerHTML='';
        exclusions[0].forEach(
            i=>codeSelector.innerHTML+='<option value="'+i[0]+'" selected>'+i[1]+'</option>'
        )
        if(response.length>0)
        {
              response.forEach(element => codeSelector.innerHTML+="<option value='"+element.id+"'>"+element.code +" - "+element.breadcrumb+"</option>");
        }
        else
        {
            codeSelector.innerHTML+='<option value="" disabled> {{__("accounting.noResults")}}</option>';
        }
	},
    error: function()
    {
            Swal.fire({
            icon: 'error',
            title: '{{__("accounting.error")}}',
            text: '{{__("accounting.errorHasOccured")}}',
            confirmButtonText: '{{__("ok")}}',
            })
    }
	});


}

function makeExclusions()
{
    var codesSelector=document.querySelector('#codes');

    exclusions=[[],[]];

    Array.from(codesSelector.selectedOptions).forEach(
        function(option)
        {
            exclusions[0].push([option.value,option.innerHTML]);
            exclusions[1].push(option.value);
        }
        );
}


    </script>
@endsection

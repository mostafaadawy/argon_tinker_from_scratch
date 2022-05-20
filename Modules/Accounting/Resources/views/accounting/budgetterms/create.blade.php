@extends('layouts.dashboard')
@section('pageTitle',$viewData['pageTitle'])
@section('contentHeaderTitle',$viewData['contentHeaderTitle'])
@section('pageContent')

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

<form method="post" action="{{ route('accounting.budgetterms.store',$viewData['type']) }}">
    @csrf

    <div class="form-group mb-2">
        <label for="name">{{__('accounting.name')}}</label>
        <input type="text" class="form-control" name="name" maxlength="120" placeholder="{{__('accounting.enterName')}}" required/>
    </div>

    

    <label for="codeSearch">{{__('accounting.codes')}}</label>


<div class='row'>
    <div class="form-group col-6 mb-2">
        <input class="form-control"  id="codeSearch"  onkeyup="searchCodes(this.value);"  name='CodeSearch' placeholder="{{__('accounting.typeToSearch')}}">
        
    </div>

    <div class="form-group col-6 mb-2">
        <select class="form-control"  id="codes" name='codes[]'  multiple required>  
            <option value=""  disabled>{{__('accounting.searchAndSelect')}}</option>
        </select>
    </div>
</div>

    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.submit')}}</button>

</form>
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
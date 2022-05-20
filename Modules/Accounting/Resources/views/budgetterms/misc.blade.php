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

@if(session()->get('success'))
<div class="alert alert-success">
  {{ session()->get('success') }}  
</div><br />
@endif

<form method="post" action="{{ route('accounting.budgetterms.miscStore',$viewData['type']) }}">
    
    @csrf


<label for="budgetTerm">{{__('accounting.term')}}</label>

<div class='row'>

    <div class="form-group col-6 mb-2">
        <input class="form-control"  id="termSearch" onkeyup="searchTerms(this.value);"  name='name' maxlength="120" placeholder="{{__('accounting.typeTermName')}}" required>
    </div>

    <div class="form-group col-6 mb-2">
        <select class="form-control"  id="terms" onchange='termBinding(this,document.querySelector("#termSearch"))' name='term'>  
            <option value="" selected> {{__("accounting.donotChooseTerm")}}</option>
        </select>
    </div>
    
</div>

    

<label for="codeSearch">{{__('accounting.codes')}}</label>


<div class='row'>
    <div class="form-group col-6 mb-2">

        <input class="form-control"  id="codeSearch"  onkeyup="searchCodes(this.value);"  name='CodeSearch' placeholder="{{__('accounting.typeToSearch')}}" >
        
    </div>

    <div class="form-group col-6 mb-2">
        <select class="form-control"  id="codes" name='codes[]'  onchange="searchCodes(document.querySelector('#codeSearch').value)" multiple required>  
            <option value=""  disabled>{{__('accounting.searchAndSelect')}}</option>
        </select>
    </div>
</div>
    <input type='number' value='0' name='add_to_existing' id='add_to_existing' hidden required/>
    <button type="submit" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> {{__('accounting.submit')}}</button>

</form>

<div class="table-responsive">

<table id='datatable' class='table text-light text-center bg-dark rounded'>
                    <thead>
                        <tr>
                            <th>{{__('accounting.code')}}</th>
                            <th>{{__('accounting.name')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
</div>





</div>
</div>

<script>




$(function () {

var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('accounting.budgetterms.misc',$viewData['type']) }}",
    columns: [
        {data: 'code', name: 'code'},
        {data: 'breadcrumb', name: 'breadcrumb'},
            ]
});

});


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

function searchTerms(key)
{
	if (key=='')
	{
		key='NaN';
	}
	
    $.ajax({
    type: "POST",
    dataType: 'json',
	url: "{{route('accounting.budgetterms.ajax',[$viewData['type'],'searchTerm'])}}",
	data:"_token={{csrf_token()}}&key="+key,	
	success: function(response){
        var termSelector=document.querySelector('#terms');
        if(response.length>0)
        {
            var terms=response;
            termSelector.innerHTML='<option value=""  selected> {{__("accounting.donotChooseTerm")}}</option>';

            terms.forEach(element => termSelector.innerHTML+="<option value='"+element.id+"'>"+element.name+"</option>");
        }
        else
        {
            if(key!='NaN')
            {
                termSelector.innerHTML='<option value="" selected> {{__("accounting.donotChooseTerm")}}</option> <option value="" disabled>{{__("accounting.noSearhResult")}}</option>';
            }
            else
            {
                termSelector.innerHTML='<option value="" selected> {{__("accounting.donotChooseTerm")}}</option> ';
            }

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

function termBinding(selection,input)
{
    if(selection.value != '')
    {
        input.value=selection.selectedOptions[0].innerHTML;
        input.hidden=true;
        selection.parentElement.classList.remove('col-6');
        document.querySelector('#add_to_existing').value=1;

    }
    else
    {
        input.value='';
        input.hidden=false;
        selection.parentElement.classList.add('col-6');
        document.querySelector('#add_to_existing').value=0;
    }
}

    </script>
@endsection
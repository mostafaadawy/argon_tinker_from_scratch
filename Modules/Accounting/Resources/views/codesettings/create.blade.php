@extends('layouts.dashboard')
@section('pageTitle',$viewData['pageTitle'])
@section('contentHeaderTitle',$viewData['contentHeaderTitle'])
@section('pageContent')

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
@endif

<script>
    var levels=4;
</script>

<form method="post" action="{{ route('accounting.codesettings.store',$viewData['type']) }}">
    @csrf

    <label for="code">{{__('accounting.searchOrCreate')}}</label>

    <div class='row'>
        <div class='col-4'> <input class="form-control mb-2 " maxlength="45" id="parentCodeSearch" onkeyup="searchCodes(this.value);" onchange="searchCodes(this.value);" name='parentCodeSearch' placeholder="{{__('accounting.typeToSearchParentCodes')}}">
        </div><div class='col-4'> <select class="form-control mb-2"  id="parentCode" onchange="updateMainParent();" name='parentCode'>  
                <option selected value> {{__("accounting.createNew")}}</option>
            </select>
        </div><div class='col-4'><button type='button' class='btn btn-primary m-1 ' id='addChild' onclick='addChildCode()'><i class="fa fa-plus-square" aria-hidden="true"></i></button></div>
    </div>

    <div class='fluid-container' id='children'>


    </div>

</div>

    <button type="submit" class="btn btn-primary mb-2" id='formSubmit' disabled><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.submit')}}</button>

</form>
</div>
</div>

<script>
function searchCodes(key)
{
    var formSubmit=document.querySelector('#formSubmit');

    $.ajax({
	type: "GET",
    dataType: 'json',
	url: "{{route('accounting.codesettings.search',[$viewData['type'],'main'])}}",
	data:"key="+key,	
	success: function(response){
        var codeSelector=document.querySelector('#parentCode');
        var codesResultsNumber = 0;
        if(response['data'] != null){
            codesResultsNumber = response['data'].length;
            }
        if(codesResultsNumber>0)
        {
            formSubmit.disabled=false;
            var codes=response.data;
            codeSelector.innerHTML='<option selected value> {{__("accounting.createNew")}}</option>';
            codes.forEach(element => codeSelector.innerHTML+="<option value='"+element.id+"'>"+element.code +" - "+element.breadcrumb+"</option>");
            formSubmit.disabled=false;

        }
        else
        {
            if(key!='')
            {
                formSubmit.disabled=false;
                codeSelector.innerHTML='<option selected value> {{__("accounting.createNew")}}</option> <option value="" disabled>{{__("accounting.noSearhResult")}}</option>';
            }
            else
            {
                formSubmit.disabled=true;
                codeSelector.innerHTML='<option selected value> {{__("accounting.createNew")}}</option> ';
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

function updatelevels()
{

    var childrenContainer=document.querySelector('#children');
    var mainCodeSelector=document.querySelector('#parentCode');
    var mainCodeInput=document.querySelector('#parentCodeSearch');
    var addChildBtn=document.querySelector('#addChild');
    var currentChildren=document.querySelectorAll('#children > .childCode');
    var maxChildren=4;

    if(mainCodeSelector.value != '')
    {
            $.ajax({
            type: "POST",
            dataType: 'json',
            url: "{{route('accounting.codesettings.getCodeLevel')}}",
            data:"_token={{csrf_token()}}&selection="+mainCodeSelector.value,	
            async : false,
            success: function(response){
                maxChildren=5-parseInt(response.level)
            },
            error: function()
            {
                    currentChildren.forEach(i=>i.remove());
                    mainCodeSelector.value='';
                    mainCodeSelector.selectedIndex=1;
                    mainCodeInput.disabled=false;
                    mainCodeInput.value='';

                    Swal.fire({
                    icon: 'error',
                    title: '{{__("accounting.error")}}',
                    text: '{{__("accounting.errorHasOccured")}}',
                    confirmButtonText: '{{__("ok")}}',
                    })

            }
            });
    }


        levels=(maxChildren- currentChildren.length);
        if(levels <=0)
        {
            if(currentChildren.length>maxChildren)
            {
                for(i=maxChildren;i<currentChildren.length;i++)
                {
                    currentChildren[i].remove();
                }
            }
            levels=0;
            addChildBtn.disabled=true;
        }
        else
        {
            addChildBtn.disabled=false;
        }


}


function updateMainParent()
{

    var mainCodeInput=document.querySelector('#parentCodeSearch');
    var mainCodeSelector=document.querySelector('#parentCode');
    var formSubmit=document.querySelector('#formSubmit');

    updatelevels();

    if(mainCodeInput.value != '' || mainCodeSelector.value != '')
    {
        formSubmit.disabled=false;

        if(mainCodeSelector.value != '')
        {
            mainCodeInput.value=mainCodeSelector.selectedOptions[0].innerText;
            mainCodeInput.disabled=true;
        }
        else
        {
            mainCodeInput.value='';
            mainCodeInput.disabled=false;
        }
    }
    else
    {
        formSubmit.disabled=true;
    }
}

function addChildCode()
{
    updatelevels();

    if(levels!=0)
    {
        var divID=revisedRandId();
        var childrenContainer=document.querySelector('#children');
        childrenContainer.insertAdjacentHTML('beforeend',
            '<div class="childCode input-group mb-2 mt-1" id="'+divID+'"><input class="form-control" type="text" name="childrenCodes[]" placeholder="{{__('accounting.name')}}" required/><button type="button" class="btn btn-primary" id="addChild" onclick="addChildCode()"><i class="fa fa-plus-square" aria-hidden="true"></i></button><div class="btn btn-danger" onclick="deleteChildCode(\''+divID+'\')"><i class="fa fa-trash" aria-hidden="true"></i></div></div>');
    }
    else
    {
                    Swal.fire({
                    icon: 'error',
                    title: '{{__("accounting.error")}}',
                    text: '{{__("accounting.cannotAddNoMore")}}',
                    confirmButtonText: '{{__("ok")}}',
                    })
    }

    updatelevels();
    handleAddBtn();


}

function handleAddBtn()
{
    btns=document.querySelectorAll('#addChild');
    btns.forEach(i=>i.hidden=true);

    btns[btns.length-1].hidden=false;
    
    if(levels==0)
    {
        btns[btns.length-1].disabled=true;
    }
    else
    {
        btns[btns.length-1].disabled=false;

    }
}

function deleteChildCode(childID)
{
    var delAfter=false;

    document.querySelectorAll('#children > .childCode').forEach(element => {
        if(element.id==childID)
        {
            element.remove();
            delAfter=true;
        } 

        if(delAfter)
        {
            element.remove();
        }
    });
  
    updatelevels();
    handleAddBtn();
}

function revisedRandId() {
     return Math.random().toString(36).replace(/[^a-z]+/g, '').substr(2, 10);
}

    </script>
@endsection
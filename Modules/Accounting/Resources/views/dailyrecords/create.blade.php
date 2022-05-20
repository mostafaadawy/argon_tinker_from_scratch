@extends('layouts.app')
@section('pageTitle',$viewData['pageTitle'])
@section('contentHeaderTitle',$viewData['contentHeaderTitle'])
@section('content')
    @include('layouts.headers.cards') {{-- to be edited in club--}}
<script>
    var rows=1;
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

<form method="post" action="{{ route('accounting.dailyrecords.store',$viewData['type']) }}" >
    @csrf

    <div class="form-group mb-2">
        <label for="date">{{__('accounting.date')}}</label>
        <input type="date" class="form-control" id="datepicker" onchange="validateDate(this.value)" name="date" value="{{old('date')}}" placeholder="{{__('accounting.date')}}" max="{{date('Y-m-d')}}" required/>
    </div>


                                <div class="table-responsive-lg">
                                    <table class='table border' id='entriesTbl' >
                                        <thead>
                                            <th>{{__('accounting.code')}}</th>
                                            <th>{{__('accounting.account')}}</th>
                                            <th>{{__('accounting.amount')}}</th>
                                            <th>{{__('accounting.dept')}}</th>
                                            <th><i class="fa fa-cogs" aria-hidden="true"></i></th>
                                        </thead>

                                        <tbody>
                                            <tr id='R1'>
                                                <td>
                                                     <select  class='selCode form-select' name='codes[]' required>
                                                                 <option value='' disabled>    {{__('accounting.chooseCode')}}</option>
                                                     </select>
                                                </td>
                                                <td>
                                                     <select  class='selAccount form-select' name='accounts[]' required>
                                                                 <option value='' disabled>    {{__('accounting.chooseAccount')}}</option>
                                                     </select>
                                                </td>
                                                <td><input type="number" class="form-control creditInput" id='C1'  name='credit[]' onkeyup="updateEntry(this)" value="0" required/></td>
                                                <td><input type="number" class="form-control debtInput" id='D1' name='debt[]' onkeyup="updateEntry(this)" value="0" required/></td>
                                                <td><button class='btn btn-danger' type="button" onclick='delRow("R1")'><i class="fa fa-trash" aria-hidden="true"  ></i></button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>


                                            <tr><td colspan="5" style="text-align: center" > <button type="button" class='btn btn-primary' onClick="addRow()" ><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.addCode')}}</button></td></tr>
                                            <tr><td colspan="5">   <div class="form-group mb-2">
                                                <label>{{__('accounting.description')}}</label>
                                                <textarea class="form-control" name="description">{{old('description')}}</textarea>
                                                </div></td></tr>
                                            <tr>
                                                <td>{{__('accounting.totalCredit')}}</td>
                                                <td><input id='totalCredit' class='form-control' value='0' disabled></td>
                                                <td>{{__('accounting.totalDebt')}}</td>
                                                <td><input id='totalDebt' class='form-control' value='0' disabled></td>
                                            </tr>
                                            <tr>
                                                <td>{{__('accounting.total')}}</td>
                                                <td><input id='total' class='form-control' value='0' disabled></td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
            </table>
        </div>
    </div>
</div>
    <button type="submit" class="btn btn-primary mb-5"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.submit')}}</button>

</form>




<script>

    $(document).ready(function() {

        initSelectors();
    });


function initSelectors()
{
    $( '.selCode' ).select2({
        ajax: {
          url: "{{route('accounting.dailyrecords.ajax',[$viewData['type'],'selCode'])}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: '{{csrf_token()}}',
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

      $( '.selAccount' ).select2({
        ajax: {
          url: "{{route('accounting.dailyrecords.ajax',['accounts','selCode'])}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              _token: '{{csrf_token()}}',
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });



    }
function updateEntry(input)
{
    inputType=input.id[0];
    rowID=input.id.substring(1);

    counterInput=document.querySelector('#'+(inputType=='C'?'D':'C')+rowID);

    counterInput.value=0;

    if([0,'0',''].indexOf(input.value)!=-1)
    {
        counterInput.readonly=false;
        input.value=0;
    }
    else
    {
        counterInput.readonly=true;

    }

    upTotals();
}

function upTotals()
{
    var totaldebt=0;
    var totalcredit=0;
    var total=0;

    document.querySelectorAll('.debtInput').forEach(i=>totaldebt+=parseFloat(i.value));
    document.querySelectorAll('.creditInput').forEach(i=>totalcredit+=parseFloat(i.value));
    total=totalcredit-totaldebt;

    document.querySelector('#totalCredit').value=parseFloat(totalcredit);
    document.querySelector('#totalDebt').value=parseFloat(totaldebt);
    document.querySelector('#total').value=parseFloat(total);

}

//Date Validation
function validateDate(date)
{
    $.ajax({
	type: "POST",
	url: "{{route('accounting.dailyrecords.ajax',[$viewData['type'],'validateDate'])}}",
    data:'_token={{csrf_token()}}&date='+date,
	success: function(response){
        var field = document.querySelector('#datepicker');
        if(response.exists)
        {
            field.value='';
            Swal.fire({
            icon: 'error',
            title: '{{__("accounting.sorry")}}',
            text: '{{__("accounting.errorDailyRecordExist")}}',
            confirmButtonText: '{{__("accounting.ok")}}',
            })

        }
	},
    error: function()
    {
            Swal.fire({
            icon: 'error',
            title: '{{__("accounting.sorry")}}',
            text: '{{__("accounting.errorProcessingYourRequest")}}',
            confirmButtonText: '{{__("accounting.ok")}}',
            })
    }
	});
}

function delRow(id)
{
    if (rows>1)
    {
        document.querySelector('#'+id).remove();
        rows=document.querySelectorAll('#entriesTbl > tbody > tr').length;
        upTotals();
    }
    else
    {
        Swal.fire({
            icon: 'error',
            title: '{{__("accounting.sorry")}}',
            text: '{{__("accounting.cannotDelRow")}}',
            confirmButtonText: '{{__("accounting.ok")}}',
            })
    }
}


function addRow()
{
    document.querySelector('#entriesTbl tbody').insertAdjacentHTML('beforeend','<tr id="R'+(rows+1)+'"> <td> <select class="selCode form-select" name="codes[]" required> </select> </td><td> <select class="selAccount form-select" name="accounts[]" required> </select> </td><td><input type="number" class="form-control creditInput" id="C'+(rows+1)+'" name="credit[]" onkeyup="updateEntry(this)" value="0" required/></td><td><input type="number" class="form-control debtInput" id="D'+(rows+1)+'" name="debt[]" onkeyup="updateEntry(this)" value="0" required/></td><td><button class="btn btn-danger" type="button" onclick="delRow(\'R'+(rows+1)+'\')"><i class="fa fa-trash" aria-hidden="true"  ></i></button></td></tr>');
    initSelectors();
    rows=document.querySelectorAll('#entriesTbl > tbody > tr').length;

}


</script>


@endsection

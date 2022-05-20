@extends('layouts.dashboard')
@section('pageTitle',$viewData['pageTitle'])
@section('contentHeaderTitle',$viewData['contentHeaderTitle'])
@section('pageContent')






    <div class="form-group mb-2">
        <label for="date">{{__('accounting.date')}}</label>
        <input type="date" class="form-control" id="datepicker"  value="{{$record->date}}" disabled/>
    </div>

    <div class="form-group mb-2">
<label >{{__('accounting.description')}}</label>
<textarea class="form-control" name="description" disabled>{{$record->description}}</textarea>
</div>

<div class="form-group mb-2">
<label >{{__('accounting.approval')}}</label>
<div class="table-responsive mb-2">

<table class="table">
    <thead>
        <tr>
            <th>{{__('accounting.reviewer_assign')}}</th>
            <th>{{__('accounting.financial_accountant_assign')}}</th>
            <th>{{__('accounting.financial_director_assign')}}</th>
            <th>{{__('accounting.director_assign')}}</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$record->reviewer_assign ? __('accounting.yes') : __('accounting.no')}}</td>
            <td>{{$record->financial_accountant_assign ? __('accounting.yes') : __('accounting.no')}}</td>
            <td>{{$record->financial_director_assign ? __('accounting.yes') : __('accounting.no')}}</td>
            <td>{{$record->director_assign ? __('accounting.yes') : __('accounting.no')}}</td>
        </tr>
    </tbody>
</table>
</div>
</div>

    <div class="table-responsive-lg">

                                    <table class='table table-stripe' >
                                        <thead>
                                            <th>{{__('accounting.code')}}</th>
                                            <th>{{__('accounting.account')}}</th>
                                            <th>{{__('accounting.amount')}}</th>
                                            <th>{{__('accounting.dept')}}</th>
                                        </thead>

                                        <tbody>

                                            @foreach ($record->entries as $entry)
                                                    <tr>
                                                        <td>   
                                                                <input class='form-control' value='{{$entry->code->code}} - {{$entry->code->breadcrumb}}' disabled> 
                                                        </td>
                                                        <td>   
                                                                <input class='form-control' value='{{$entry->account->code}} - {{$entry->account->breadcrumb}}' disabled> 
                                                        </td>
                                                        <td><input type="number" class="form-control" value="{{$entry->credit}}" disabled/></td>
                                                        <td><input type="number" class="form-control"  value="{{$entry->dept}}" disabled/></td>
                                                    </tr>
                                            @endForeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td>{{__('accounting.totalCredit')}}</td>
                                                <td><input id='totalCredit' class='form-control' value='{{$record->credit}}' disabled></td>
                                                <td>{{__('accounting.totalDept')}}</td>
                                                <td><input id='totalDebt' class='form-control' value='{{$record->dept}}' disabled></td>
                                            </tr>
                                            <tr>
                                                <td>{{__('accounting.total')}}</td>
                                                <td><input id='total' class='form-control' value='{{$record->total}}' disabled></td>
                                            </tr>


                                        </tfoot>    

                                    </table>
    </div>                 





@endsection
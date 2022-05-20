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



<form method="post" action="{{ route('accounting.report.generate') }}"  class='text-center' onsubmit="injectData()">
   
    @csrf

    <div class='row'>
        <div class="form-group mb-2 col-6">
            <label for="date">{{__('accounting.startDate')}}</label>
            <input type="date" class="form-control" id="datepicker" onchange="validateDate(this.value,'start')" name="startDate" value="{{old('startDate')}}" placeholder="{{__('accounting.date')}}"  required/>
        </div>
        <div class="form-group mb-2 col-6">
            <label for="date">{{__('accounting.endDate')}}</label>
            <input type="date" class="form-control" id="datepicker" onchange="validateDate(this.value,'end')" name="endDate" value="{{old('endDate')}}" placeholder="{{__('accounting.date')}}"  required/>
        </div>
    
    </div>

        <div class="table-responsive">
            <table class='table'>
                <thead>
                    <th>{{__('accounting.revenue')}}</th>
                    <th>{{__('accounting.expenses')}}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name='revenueMisc' id="revenueMisc" checked>
                                <label class="form-check-label" for="revenueMisc">{{__('accounting.includeRevenueMisc')}}</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="expensesMisc" id="expensesMisc" checked>
                                <label class="form-check-label" for="expensesMisc">{{__('accounting.includeExpensesMisc')}}</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="advancedReport" id="advancedReport" >
                                <label class="form-check-label" for="advancedReport">{{__('accounting.advancedReport')}}</label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('accounting.submit')}}</button>
</form>


@endsection

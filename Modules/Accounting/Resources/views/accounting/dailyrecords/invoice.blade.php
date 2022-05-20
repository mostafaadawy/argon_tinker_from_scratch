<html>
<head>
    <meta charset="UTF-8">

    <title>{{__('accounting.report')}}</title>
    <style>
        table, th, td {
  border: 1px solid black;
}

td
{
    padding:2px;
    
}


th
{
    padding:2px;
}


        </style>
</head>
<body>

<center>
    <div style='width:100%;text-align:center'>
        <h1>
            <b style="text-align:center">
                {{__('accounting.report')}} :  {{$type}} : {{$record['date']}}
            </b>
        </h1>
    </div>


    <div >
<label>{{__('accounting.description')}}</label>
<div name="description" style="width:100%;background-color:#ffffff;">{{$record->description}}</div>
</div>

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


    <table style="text-align: center" >
        <thead>

            <tr>
                <th>{{__('accounting.dept')}}</th>
                <th>{{__('accounting.credit')}}</th>
            </tr>

        </thead>
        <tbody>
            <tr>
            <td>
                <table>
                    <thead>
                        <tr>
                            <th colspan="3">
                            </th>
                        </tr>
                        <tr>
                        <th>
                            {{__('accounting.code')}}
                        </th>
                        <th>
                            {{__('accounting.account')}}
                        </th>
                        <th>
                            {{__('amount')}}
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($record->entries->where('dept','>','0') as $entry)
                                <tr>
                                <td>{{$entry->code['code']}} - {{$entry->code['breadcrumb']}}</td>
                                <td>{{$entry->account['code']}} - {{$entry->account['breadcrumb']}}</td>
                                    <td>{{$entry['dept']}}</td>
                                </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <thead>
                        <tr>
                            <th colspan="3">
                            </th>
                        </tr>
                        <tr>
                        <th>
                            {{__('accounting.code')}}
                        </th>
                        <th>
                            {{__('accounting.account')}}
                        </th>
                        <th>
                            {{__('amount')}}
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($record->entries->where('credit','>','0') as $entry)
                            <tr>
                                <td>{{$entry->code['code']}} - {{$entry->code['breadcrumb']}}</td>
                                <td>{{$entry->account['code']}} - {{$entry->account['breadcrumb']}}</td>
                                <td>{{$entry['credit']}}</td>
                            </tr>
                         @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    {{$record['dept']}}
                </td>
                <td>
                    {{$record['credit']}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    {{$record['total']}}
                </td>
            </tr>
            </tfoot>
    </table>




</center>
</body>
</html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{__('accounting.report')}}</title>
    <style>

        table, th, td {
  border: 1px solid black;
}

td
{
    padding:5px;
}


        </style>
</head>
<body>

<center>
    <div style='width:100%;text-align:center'>
        <h1>
            <b>
                {{__('report')}}
            </b>
        </h1>
        <h3>
            <b>
                {{__('accounting.startDate')}} : {{$startDate}}  -- {{__('accounting.endDate')}} : {{$endDate}}
            </b>
        </h3>
    </div>
    <table style="text-align: center" >
        <thead>
            <tr>
            <th>{{__('accounting.revenue')}}</th>

            <th>{{__('accounting.expenses')}}</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        @foreach ($revenTerms as $term)
                            <table>
                                <thead>
                                    <tr>
                                    <th>
                                        {{__('accounting.name')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalCredit')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalDept')}}
                                    </th>  
                                    <th>
                                        {{__('accounting.total')}}
                                    </th>
                                </tr>                                                                        
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$term['name']}}</td>
                                        <td>{{$term['totalCredit']}}</td>
                                        <td>{{$term['totalDept']}}</td>
                                        <td>{{$term['total']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(!empty($term['subCodes']))
                                    <table>
                                        <thead>
                                            <tr>
                                            <th>
                                                {{__('accounting.code')}}
                                            </th>

                                            <th>
                                                {{__('accounting.name')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalCredit')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalDept')}}
                                            </th>  
                                            <th>
                                                {{__('accounting.total')}}
                                            </th> 
                                        </tr>                                                                       
                                        </thead>
                                        <tbody>
                                    @foreach ($term['subCodes'] as $code)
                                            <tr>
                                                <td>{{$code['code']}}</td>
                                                <td>{{$code['breadcrumb']}}</td>
                                                <td>{{$code['report']['totalCredit']}}</td>
                                                <td>{{$code['report']['totalDept']}}</td>
                                                <td>{{$code['report']['total']}}</td>
                                            </tr>
                                    @endforeach                          
                                        </tbody>
                                    </table>
                            @endif  
                        @endforeach
                        @isset($revenMiscTerm)
                            <table>
                                <thead>
                                    <tr>
                                    <th>
                                        {{__('accounting.name')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalCredit')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalDept')}}
                                    </th>  
                                    <th>
                                        {{__('accounting.total')}}
                                    </th>        
                                    </tr>                                                                
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$revenMiscTerm['name']}}</td>
                                        <td>{{$revenMiscTerm['totalCredit']}}</td>
                                        <td>{{$revenMiscTerm['totalDept']}}</td>
                                        <td>{{$revenMiscTerm['total']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                                @if(!empty($revenMiscTerm['subCodes']))
                                    <table>
                                        <thead>
                                            <tr>
                                            <th>
                                                {{__('accounting.code')}}
                                            </th>

                                            <th>
                                                {{__('accounting.name')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalCredit')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalDept')}}
                                            </th>  
                                            <th>
                                                {{__('accounting.total')}}
                                            </th>      
                                            </tr>                                                                  
                                        </thead>
                                        <tbody>
                                    @foreach ($revenMiscTerm['subCodes'] as $code)
                                            <tr>
                                                <td>{{$code['code']}}</td>
                                                <td>{{$code['breadcrumb']}}</td>
                                                <td>{{$code['report']['totalCredit']}}</td>
                                                <td>{{$code['report']['totalDept']}}</td>
                                                <td>{{$code['report']['total']}}</td>
                                            </tr>
                                    @endforeach                          
                                        </tbody>
                                    </table>
                            @endif  
                        @endisset


                    </td>

                    <td>

                        @foreach ($expenTerms as $term)
                            <table>
                                <thead>
                                    <tr>
                                    <th>
                                        {{__('accounting.name')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalCredit')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalDept')}}
                                    </th>  
                                    <th>
                                        {{__('accounting.total')}}
                                    </th>   
                                    </tr>                                                                     
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$term['name']}}</td>
                                        <td>{{$term['totalCredit']}}</td>
                                        <td>{{$term['totalDept']}}</td>
                                        <td>{{$term['total']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(!empty($term['subCodes']))
                                    <table>
                                        <thead>
                                            <tr>

                                            <th>
                                                {{__('accounting.code')}}
                                            </th>

                                            <th>
                                                {{__('accounting.name')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalCredit')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalDept')}}
                                            </th>  
                                            <th>
                                                {{__('accounting.total')}}
                                            </th>      
                                            </tr>                                                                  
                                        </thead>
                                        <tbody>
                                    @foreach ($term['subCodes'] as $code)
                                            <tr>
                                                <td>{{$code['code']}}</td>
                                                <td>{{$code['breadcrumb']}}</td>
                                                <td>{{$code['report']['totalCredit']}}</td>
                                                <td>{{$code['report']['totalDept']}}</td>
                                                <td>{{$code['report']['total']}}</td>
                                            </tr>
                                    @endforeach                          
                                        </tbody>
                                    </table>
                            @endif
                        @endforeach

                        @isset($expenMiscTerm)
                            <table>
                                <thead>
                                    <tr>
                                    <th>
                                        {{__('accounting.name')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalCredit')}}
                                    </th>
                                    <th>
                                        {{__('accounting.totalDept')}}
                                    </th>  
                                    <th>
                                        {{__('accounting.total')}}
                                    </th>         
                                </tr>                                                               
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$expenMiscTerm['name']}}</td>
                                        <td>{{$expenMiscTerm['totalCredit']}}</td>
                                        <td>{{$expenMiscTerm['totalDept']}}</td>
                                        <td>{{$expenMiscTerm['total']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(!empty($expenMiscTerm['subCodes']))
                                    <table>
                                        <thead>
                                            <tr>
                                            <th>
                                                {{__('accounting.code')}}
                                            </th>

                                            <th>
                                                {{__('accounting.name')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalCredit')}}
                                            </th>
                                            <th>
                                                {{__('accounting.totalDept')}}
                                            </th>  
                                            <th>
                                                {{__('accounting.total')}}
                                            </th>
                                        </tr>                                                                        
                                        </thead>
                                        <tbody>
                                    @foreach ($expenMiscTerm['subCodes'] as $code)
                                            <tr>
                                                <td>{{$code['code']}}</td>
                                                <td>{{$code['breadcrumb']}}</td>
                                                <td>{{$code['report']['totalCredit']}}</td>
                                                <td>{{$code['report']['totalDept']}}</td>
                                                <td>{{$code['report']['total']}}</td>
                                            </tr>
                                    @endforeach                          
                                        </tbody>
                                    </table>
                            @endif  
                        @endisset

                    </td>
                </tr>
        </tbody>
    </table>

</center>

</body>
</html>
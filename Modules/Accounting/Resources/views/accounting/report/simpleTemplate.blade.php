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
                        <ul>
                        @foreach ($revenTerms as $term)
                            <li>
                                    <h3><b>{{$term['name']}} : {{$term['total']}}</b></h3>
                                @if(!empty($term['subCodes']))
                                    <ol>
                                        @foreach ($term['subCodes'] as $code)
                                                <li>
                                                    <h4> {{$code['code']}}/{{$code['breadcrumb']}} : {{$code['report']['total']}}</h4>
                                                </li>
                                        @endforeach 
                                    </ol>                         
                                @endif  
                            </li>
                        @endforeach

                        @isset($revenMiscTerm)
                            <li>
                                <h3><b>{{$revenMiscTerm['name']}} : {{$revenMiscTerm['total']}}</b></h3>
                            @if(!empty($revenMiscTerm['subCodes']))
                                <ol>
                                    @foreach ($revenMiscTerm['subCodes'] as $code)
                                            <li>
                                                <h4> {{$code['code']}}/{{$code['breadcrumb']}} : {{$code['report']['total']}}</h4>
                                            </li>
                                    @endforeach 
                                </ol>                         
                            @endif  
                            </li>
                        @endisset

                        </ul>
                    </td>

                    <td>
                        <ul>
                        @foreach ($expenTerms as $term)
                            <li>
                                <h3><b>{{$term['name']}} : {{$term['total']}}</b></h3>
                            @if(!empty($term['subCodes']))
                                <ol>
                                    @foreach ($term['subCodes'] as $code)
                                            <li>
                                                <h4> {{$code['code']}}/{{$code['breadcrumb']}} : {{$code['report']['total']}}</h4>
                                            </li>
                                    @endforeach 
                                </ol>                         
                            @endif
                            </li>  
                        @endforeach

                        @isset($expenMiscTerm)
                            <li>
                                <h3><b>{{$expenMiscTerm['name']}} : {{$expenMiscTerm['total']}}</b></h3>
                            @if(!empty($expenMiscTerm['subCodes']))
                                <ol>
                                    @foreach ($expenMiscTerm['subCodes'] as $code)
                                            <li>
                                                <h4> {{$code['code']}}/{{$code['breadcrumb']}} : {{$code['report']['total']}}</h4>
                                            </li>
                                    @endforeach 
                                </ol>                         
                            @endif  
                            </li>
                        @endisset
                        </ul>
                    </td>
                </tr>
        </tbody>
    </table>

</center>

</body>
</html>
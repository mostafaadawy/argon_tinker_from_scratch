<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CodeSettingsView extends Model
{
    protected $table='code_settings_view';


    public function getPeriodReport($request)
    {

        $itemEntries=DB::select("call getCodeEntries(?,?,?)",[$this->id,$request->input('startDate'),$request->input('endDate')]);

        $itemEntries=empty($itemEntries)?
                        ['totalCredit'=>0,'totalDept'=>0,'total'=>0]:
                        ['totalCredit'=>$itemEntries[0]->totalCredit,
                         'totalDept'=>$itemEntries[0]->totalDept,
                        'total'=>$itemEntries[0]->total];


        $itemEntries=array_map(
            function($elem){return is_null($elem)?0:$elem;}
            ,$itemEntries);

        return['code'=>$this->code,'breadcrumb'=>$this->breadcrumb,'report'=>$itemEntries];
    }
}

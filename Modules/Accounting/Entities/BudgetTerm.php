<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounting\TermItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetTerm extends Model
{

    protected $fillable = 
    [
        'name',
        'type'
    ];

    public function validate(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|max:120|unique:App\Models\Accounting\BudgetTerm,name,'.$this->id.',id,type,'.$this->type
            ]
            );
    }
    public function items()
    {
        return $this->hasMany(TermItem::class);
    }

    public function setName($name)
    {
        $this->attributes['name']=$name;
    }


    public function getPeriodReport($request)
    {
        $subCodes=[];

        $totalCredit=0;
        $totalDept=0;

        foreach($this->items as $item)
        {
            $report=$item->code->getPeriodReport($request);
            $totalCredit+=$report['report']['totalCredit'];
            $totalDept+=$report['report']['totalDept'];
            array_push($subCodes,$report);
        }

        return ['name'=>$this['name'],'totalCredit'=>$totalCredit,'totalDept'=>$totalDept,'total'=>$totalCredit-$totalDept,'subCodes'=>$subCodes];

    }

}

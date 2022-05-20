<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounting\BudgetTerm;
use Illuminate\Http\Request;

class TermItem extends Model
{
    protected $fillable = 
    [
        'code_setting_id',
        'budget_term_id'
    ];

    public function code()
    {
        return $this->belongsTO(CodeSettingsView::class,'code_setting_id');
    }

    public function term()
    {
        return $this->belongsTO(BudgetTerm::class);
    }
}

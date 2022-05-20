<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyRecordsEntrie extends Model
{
    protected $fillable =[
        'daily_records_id',
        'code_settings_id',
        'account_id',
        'credit',
        'dept'
    ];

    public function dailyRecord()
    {
        return $this->belongsTo(DailyRecords::class,'daily_records_id');
    }

    public function code()
    {
        return $this->belongsTo(CodeSettingsView::class,'code_settings_id');
    }

    public function account()
    {
        return $this->belongsTo(CodeSettingsView::class,'account_id');
    }

}

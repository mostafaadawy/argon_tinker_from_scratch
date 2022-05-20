<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;

class DailyRecords extends Model
{
    protected $table='daily_records';

    protected $fillable =[
        'date',
        'type',
        'description'
    ];

    public function entries()
    {
        return $this->hasMany(DailyRecordsEntrie::class,'daily_records_id');
    }

}

<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

class DailyRecordsView extends Model
{
    protected $table='daily_records_view';

    public function entries()
    {
        return $this->hasMany(DailyRecordsEntrie::class,'daily_records_id');    
    }
}


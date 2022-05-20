<?php

namespace Modules\Accounting\Entities;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CodeSetting extends Model
{
    private const TYPES=['revenue','expenses','accounts'];
    private const TYPES_ENUM=['REVEN','EXPEN','ACC'];

    protected $fillable =[
        'name',
        'type',
        'is_main',
        'code_settings_id'
    ];



    public function parentCode()
    {
        return $this->belongsTo(CodeSetting::class, 'code_settings_id');
    }

    public function childrenCodes()
    {
        return $this->hasMany(CodeSetting::class, 'code_settings_id');
    }


    public static function getTypeEnum($type)
    {
        if(!in_array($type,CodeSetting::TYPES))
        {
            throw new Exception('Non Valid Type');
            die();
        }
        else
        {
            return CodeSetting::TYPES_ENUM[array_search($type,CodeSetting::TYPES)];
        }
    }

    public static function verifyType($type)
    {
        if(in_array($type,CodeSetting::TYPES))
        {
            return true;
        }

        return false;
    }

    public static function getRoutingTypeValidator()
    {
        return implode('|',CodeSetting::TYPES);
    }
}

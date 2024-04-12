<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Setting\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'group',
        'name',
        'label',
        'type',
        'value',
    ];

    protected static function newFactory(): SettingFactory
    {
        //return SettingFactory::new();
    }
}

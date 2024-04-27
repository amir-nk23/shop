<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\Database\Factories\SmsTokenFactory;

class SmsToken extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'mobile',
        'token',
        'expires_at',
        ];

    protected $table = 'smsTokens';
    protected static function newFactory(): SmsTokenFactory
    {
        //return SmsTokenFactory::new();
    }
}

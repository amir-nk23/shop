<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory,
        HasApiTokens;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'mobile',
        'password',
        'email',
        'national_code',
        'mobile_verified_at',
        'status',

    ];

    public function addresses(){

        return $this->hasMany(Addresses::class,'customer_id');

    }

    public function totalPriceForCart(){

    dd($this->id);


    }

}

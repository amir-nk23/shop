<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customer\Database\Factories\AddressesFactory;

class Addresses extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'customer_id',
        'name',
        'mobile',
        'city_id',
        'address',
        'postal_code',


    ];

    public function customer(){

        return $this->belongsTo(Customer::class);

    }

}

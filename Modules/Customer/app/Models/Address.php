<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Area\Entities\City;
use Modules\Customer\Database\Factories\AddressFactory;

class Address extends Model
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

    protected static function newFactory(): AddressFactory
    {
        //return AddressFactory::new();
    }

    public function city(){

        return $this->belongsTo(City::class);

    }

    public function customer(){

        return $this->belongsTo(Customer::class);

    }

}

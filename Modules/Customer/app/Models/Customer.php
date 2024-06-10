<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Cart\Models\Cart;

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

        return $this->hasMany(Address::class,'customer_id');

    }

    public function totalPriceForCart(){

        $carts = $this->carts()->get();

        $sum = 0;



        foreach ($carts as $cart){

           $total = $cart->quantity * $cart->price;

           $sum +=$total;
        }




        return $sum;


    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}

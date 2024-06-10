<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Order\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'customer_id',
        'address_id',
        'address',
        'amount',
        'description',
        'status',

    ];



    protected $casts = [

      'address'=> 'json',

    ];
    protected static function newFactory(): OrderFactory
    {
        //return OrderFactory::new();
    }

    public function product(){



    }
}

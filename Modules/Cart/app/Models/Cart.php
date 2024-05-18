<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Modules\Cart\Database\Factories\CartFactory;
use Modules\Customer\Models\Customer;
use Modules\Product\Models\Product;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'price',
        'customer_id',
        'product_id',
        'quantity',

    ];



    public function product(): BelongsTo
    {

        return $this->belongsTo(Product::class);

    }

    public function customer(): BelongsTo
    {

        return $this->BelongsTo(Customer::class);

    }

//    public function checkQuantity(){
//
//            $notification = [];
//            Product::query()->where('cart_id',$this->id)->get();
//            dd('hi');
//
//
//    }
}

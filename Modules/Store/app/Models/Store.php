<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Models\Product;
use Modules\Store\Database\Factories\StoreFactory;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'product_id',
        'balance',
    ];

    protected $table = 'stores';

    public function product(){

        $this->belongsTo(Product::class);

    }

    public function storetransactions(){

        return $this->hasMany(StoreTransaction::class,'store_id');


    }
}

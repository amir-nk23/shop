<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Store\Database\Factories\StoreTransactionFactory;

class StoreTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'store_id',
        'order_id',
        'type',
        'quantity',
        'description',
    ];

    protected $table = 'storetransactions';


    public function store(){

        return $this->belongsTo(Store::class);

    }

}

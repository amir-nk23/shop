<?php

namespace Modules\Invoice\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoice\Database\Factories\InvoiceFactory;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'order_id',
        'amount',
        'status',


    ];

    protected static function newFactory(): InvoiceFactory
    {
        //return InvoiceFactory::new();
    }
}

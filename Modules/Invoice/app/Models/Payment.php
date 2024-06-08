<?php

namespace Modules\Invoice\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoice\Database\Factories\PaymentFactory;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'invoice_id',
        'token',
        'driver',
        'tracking_code',
        'description',
        'amount',
        'status',
    ];

    protected static function newFactory(): PaymentFactory
    {
        //return PaymentFactory::new();
    }

    public function invoice() :BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}

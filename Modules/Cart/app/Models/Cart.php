<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Cart\Database\Factories\CartFactory;
use Modules\Customer\Models\Customer;
use Modules\Product\Models\Product;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];



    public function products(): HasMany
    {

        return $this->hasMany(Product::class);

    }

    public function customer(): BelongsTo
    {

        return $this->belongsTo(Customer::class);

    }
}

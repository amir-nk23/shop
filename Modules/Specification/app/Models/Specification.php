<?php

namespace Modules\Specification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Models\Category;
use Modules\Specification\Database\Factories\SpecificationFactory;

class Specification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'name',
        'status'
    ];

    protected static function newFactory(): SpecificationFactory
    {
        //return SpecificationFactory::new();
    }

    public function categories()
    {

        return $this->belongsToMany(Category::class,'category_specification');

    }
}

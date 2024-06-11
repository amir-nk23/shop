<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\CategoryFactory;
use Modules\Specification\Models\Specification;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'name',
        'parent_id',
        'featured',
        'status',

    ];

    protected static function newFactory(): CategoryFactory
    {
        //return CategoryFactory::new();
    }

    public function children()
    {

        return $this->hasMany(Category::class,'parent_id');

    }

    public function recursiveChildren(){



      return  $this->children()->with('parent');

    }

    public function parent(){

        return $this->belongsTo(Category::class,'parent_id');

    }

    public function specifications()
    {

        return $this->belongsToMany(Specification::class,'category_specification');

    }

    public function products(){

        return $this->hasMany(Product::class);

    }
}

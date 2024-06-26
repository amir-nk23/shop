<?php

namespace Modules\Product\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Models\Cart;
use Modules\Specification\Models\Specification;
use Modules\Store\Models\Store;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia,Viewable
{
    use HasFactory,InteractsWithMedia,InteractsWithViews;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'title',
        'description',
        'category_id',
        'status',
        'discount',
        'price',
        'quantity',

    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->usingLanguage('')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(190);
    }


    public static function getTopDiscountedProducts()
    {
        $topDiscountedProducts = DB::select("select `id`, `title`,`status`,`price`, IF( `discount_type` = 'percent', (`discount`/100) * `price`, `discount`) AS `total_discount` FROM `products`  WHERE `status` = 'available' ORDER BY `total_discount` DESC LIMIT 10;");

        return $topDiscountedProducts;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function store(){

        $this->hasOne(Store::class);

    }

    public function specifications(){

        return $this->belongsToMany(Specification::class,'product_specification')->withPivot(['value']);

    }



    //start media-library
    protected $with = ['media'];

    protected $hidden = ['media'];

    protected $appends = ['image', 'galleries'];

//    public function registerMediaCollections() : void
//    {
//        $this->addMediaCollection('product_images')->singleFile();
//        $this->addMediaCollection('product_galleries');
//    }


    protected function image(): Attribute
    {
        $media = $this->getFirstMedia('product_images');

        return Attribute::make(
            get: fn () => [
                'id' => $media?->id,
                'url' => $media?->getFullUrl(),
                'name' => $media?->file_name
            ],
        );
    }

    protected function galleries(): Attribute
    {
        $media = $this->getMedia('product_galleries');

        $galleries = [];
        if ($media->count()) {
            foreach ($media as $mediaItem) {
                $galleries[] = [
                    'id' => $mediaItem?->id,
                    'url' => $mediaItem?->getFullUrl(),
                    'name' => $mediaItem?->file_name
                ];
            }
        }

        return Attribute::make(
            get: fn () => $galleries,
        );
    }

    public function uplaodProductFile(\Illuminate\Http\Request $request){


        if ($request->hasFile('image') && $request->file('image')->isValid())
        {


            $this->addImage($request->file('image'));

        }

        foreach ($request->file('images') as $image){

            $this->addGallery($image);


        }


    }



    public function addImage(UploadedFile $file)
    {
        return $this->addMedia($file)->toMediaCollection('product_images');
    }


    public function addGallery(UploadedFile $file)
    {
        return $this->addMedia($file)->toMediaCollection('product_galleries');
    }
    //End media-library

    public function carts(): HasMany
    {

        return $this->hasMany(Cart::class);


    }

}

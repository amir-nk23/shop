<?php

namespace Modules\Slider\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model  implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'link',
        'status'

    ];

//    protected static function newFactory(): SliderFactory
//    {
//        //return SliderFactory::new();
//    }

    //    start media-library

    protected $with = ['media'];

    protected $hidden = ['media'];

    protected $appends = ['image'];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('slider_images')->singleFile();
    }

    public function addImage(UploadedFile $file){


        return $this->addMedia($file)->toMediaCollection('slider_images');

    }

    public function uploadFile(Request $request){


        if ($request->hasFile('image') && $request->file('image')->isValid())
        {

            $this->addImage($request->file('image'));

        }


    }

    protected function image(): Attribute
    {

        $media = $this->getFirstMedia('slider_images');
        return Attribute::make(

            get: fn () => [
                'id' => $media?->id,
                'url'=> $media?->getFullUrl(),
                'name'=>$media?->file_name

            ]

        );



    }

}

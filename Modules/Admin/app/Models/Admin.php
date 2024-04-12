<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Database\Factories\AdminFactory;

class Admin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile'
    ];

//    protected static function newFactory(): AdminFactory
//    {
//        //return AdminFactory::new();
//    }

    public static function clearAllCaches(){

        if (Cache::has('admin')){

            Cache::forget('admin');

        }

    }


//    protected static function boot()
//    {
//        static::created(function (){
//
////            activity()->log("کاربر با شناسه".Auth::id()."یک دکتر جدید با شناسه".$doctor->id."ایجاد کرد");
//            static::clearAllCaches();
//
//        });
//        static::updated(function (){
//
////            activity()->log("کاربر با شناسه".Auth::id()." دکتر  با شناسه".$doctor->id."را اپدیت کرد");
//            static::clearAllCaches();
//
//        });
//
//        static::deleted(function (){
//
////            activity()->log("کاربر با شناسه".Auth::id()." دکتر  با شناسه".$doctor->id."را حذف کرد");
//            static::clearAllCaches();
//
//        });
//    }
}

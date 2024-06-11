<?php

use Illuminate\Support\Facades\Route;
use Modules\Slider\Http\Controllers\Admin\SliderController;



Route::prefix('admin/')->group(function()
{

//    Route::get('slider/index',[SliderController::class,'index']);

    Route::get('store',[SliderController::class,'store']);

    Route::resource('slider',SliderController::class);

});

Route::prefix('/front')->group(function()
{

    Route::get('slider',[\Modules\Slider\Http\Controllers\SliderController::class,'index']);

});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Slider\Http\Controllers\Admin\SliderController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/


Route::group([],function()
{

//    Route::get('slider/index',[SliderController::class,'index']);

    Route::resource('slider',SliderController::class);

});

Route::prefix('/front')->group(function()
{

    Route::get('slider',[\Modules\Slider\Http\Controllers\SliderController::class,'index']);

});

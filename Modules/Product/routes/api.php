<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Admin\CategoryController;
use Modules\Product\Http\Controllers\ProductController;

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



Route::resource('product',\Modules\Product\Http\Controllers\Admin\ProductController::class);

Route::prefix('front/')->group(function (){

    Route::get('product',[\Modules\Product\Http\Controllers\Api\Front\ProductController::class,'index']);
    Route::get('product/1',[\Modules\Product\Http\Controllers\Api\Front\ProductController::class,'show']);

});

Route::resource('category',CategoryController::class);

<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\Api\Customer\CartController;


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

Route::middleware('auth:customer-api')->prefix('customer/')->group(function (){


    Route::post('cart', [CartController::class,'store']);
    Route::get('cart', [CartController::class,'index']);

});

Route::middleware('auth:admin-api')->prefix('admin/')->group(function (){

    Route::get('cart/{id}', [\Modules\Cart\Http\Controllers\Api\Admin\CartController::class,'show']);

});

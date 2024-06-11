<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderController;

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

Route::middleware('auth:customer-api')->group(function () {

    Route::apiResource('order', OrderController::class)->names('order');

    Route::prefix('customer')->group(function (){
        Route::post('/purchase', [\Modules\Order\Http\Controllers\Api\Customer\OrderController::class,'purchase'])->name('payments.parchase');
        Route::get('/orders', [OrderController::class,'index']);
        Route::get('/orders/{order}', [OrderController::class,'show']);


    });


});

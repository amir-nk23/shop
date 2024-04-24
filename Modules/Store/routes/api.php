<?php

use Illuminate\Support\Facades\Route;
use Modules\Store\Http\Controllers\StoreController;

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



Route::prefix('store')->group(function (){

    Route::resource('store',StoreController::class);

});

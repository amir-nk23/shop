<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\Http\Controllers\HomeController;

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


Route::prefix('front/')->group(function (){

    Route::get('home', [\Modules\Home\Http\Controllers\Api\HomeController::class,'home']);

});

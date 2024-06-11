<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

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


Route::prefix('customer')->middleware('guest')->group(function (){

    Route::post('/registerLogin',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'registerLogin']);
    Route::post('/smstoken',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'sendToken']);
    Route::post('/verify',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'verify']);
    Route::post('/register',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'register']);
    Route::post('/login',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'login']);


});

Route::prefix('admin')->middleware('guest')->group(function (){

    Route::post('/login',[\Modules\Auth\Http\Controllers\Api\Admin\AuthController::class,'login']);


});

Route::prefix('customer')->middleware('auth:customer-api')->group(function (){

    Route::post('/logout',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'logout']);

});


Route::prefix('admin')->middleware('auth:admin-api')->group(function (){

    Route::post('/logout',[\Modules\Auth\Http\Controllers\Api\Admin\AuthController::class,'logout']);

});

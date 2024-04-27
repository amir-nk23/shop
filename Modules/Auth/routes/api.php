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



Route::post('customer/registerLogin',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'registerLogin']);
Route::post('/smstoken',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'sendToken']);
Route::post('/verify',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'verify']);
Route::post('customer/register',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'register']);
Route::post('customer/login',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'login']);
Route::post('customer/logout',[\Modules\Auth\Http\Controllers\Api\Customer\AuthController::class,'logout']);

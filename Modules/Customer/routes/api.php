<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\AddressController;
use Modules\Customer\Http\Controllers\Api\Customer\CustomerController;
use Modules\Customer\Http\Controllers\Api\Admin\DashboardController;



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




Route::prefix('dashboard/')->group(function (){

    Route::resource('customer', DashboardController::class);

});



Route::prefix('customer/')->group(function (){


    Route::get('addresses/{customer}',[CustomerController::class,'indexAddress']);
    Route::post('address',[AddressController::class,'store']);
    Route::post('addresses',[CustomerController::class,'indexStore']);
    Route::get('profile/{id}',[CustomerController::class,'profile']);
    Route::patch('profile/{customer}',[CustomerController::class,'updateProfile']);
    Route::put('change-password',[CustomerController::class,'changePassword']);


});


<?php

use Illuminate\Support\Facades\Route;
use Modules\Specification\Http\Controllers\SpecificationController;

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

Route::group([],function () {
    Route::resource('specification', \Modules\Specification\Http\Controllers\Admin\SpecificationController::class);
});

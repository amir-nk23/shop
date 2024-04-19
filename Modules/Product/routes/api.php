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

Route::prefix('category')->group( function () {
    Route::resource('category', CategoryController::class);
});

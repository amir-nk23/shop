<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\SettingController;

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

Route::prefix('/setting')->group(function (){

    Route::get('/general', [SettingController::class,'general'])->name('setting.general');
    Route::get('/social', [SettingController::class,'social'])->name('setting.social');
    Route::patch('', [SettingController::class,'update'])->name('setting.update');
    Route::delete('/delete/img/{setting}', [SettingController::class,'destroy'])->name('setting.destroy');
});

<?php


use Illuminate\Routing\Route;
use Modules\Core\Http\Controllers\Admin\MediaController;

Route::delete('media/{media}',[MediaController::class,'destroyFile'])->name('media.destroy');

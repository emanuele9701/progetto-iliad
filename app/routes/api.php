<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['as' => 'api.'],function () {
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [\App\Http\Controllers\OrderApiController::class, 'index'])->name('lista');
        Route::get('/stats', [\App\Http\Controllers\OrderApiController::class, 'stats'])->name('stats');
        Route::delete('{order}/destroy',[\App\Http\Controllers\OrderApiController::class,'destroy'])->name('destroy');
        Route::put('{order}/update',[\App\Http\Controllers\OrderApiController::class,'update'])->name('update');
        Route::post('store',[\App\Http\Controllers\OrderApiController::class,'store'])->name('store');
        Route::get('{order}',[\App\Http\Controllers\OrderApiController::class,'show'])->name('info');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [\App\Http\Controllers\ProductApiController::class, 'index'])->name('lista');
    });
});

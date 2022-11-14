<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(\App\Http\Controllers\Product::class)->group(function (){
    Route::get('/product', 'index');
    Route::post('/product', 'store');
    Route::put('/product/{id}', 'update');
    Route::delete('/product/{id}', 'destroy');
});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('chamados', App\Http\Controllers\CalledController::class);

Route::resource('vendedores', App\Http\Controllers\SellerController::class);
Route::get('/vendedores-delete/{vendedore}', [App\Http\Controllers\SellerController::class, 'delete'])->name('vendedores.delete');

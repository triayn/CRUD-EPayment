<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/produks', \App\Http\Controllers\ProdukController::class);

Route::resource('/suppliers', \App\Http\Controllers\SupplierController::class);

Route::resource('/karyawan', \App\Http\Controllers\UserController::class);
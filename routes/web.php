<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/orders', [OrderController::class, 'index']);
Route::resource('orders', OrderController::class);
Route::resource('/products', ProductsController::class);
Route::put('/products/{id}', 'ProductController@update')->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::resource('/suppliers', 'SupplierController');
Route::resource('/users', App\Http\Controllers\UserController::class);
Route::resource('/companies', 'CompanyController');
Route::resource('/transactions', 'TransactionController');
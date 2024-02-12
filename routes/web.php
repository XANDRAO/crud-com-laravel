<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;


Route::resource('products', ProductController::class);

route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('admin', function () {})->name('admin');

Route::any('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

Route::resource('categories', CategoryController::class);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});
<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReturnProductsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\UsersController;
use App\Models\ReturnProduct;
use Illuminate\Support\Facades\Route;







Route::get('/', function () {
    return redirect('/login');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/logout', [UsersController::class, 'logout'])->name('users.logout');

Route::middleware(['auth:sanctum'])->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //User
    Route::resource('users', UsersController::class);

    //Category
    Route::resource('/categories', CategoriesController::class);
    Route::get('/api/categories', [CategoriesController::class, 'getCategoriesJson']);
    //Brand
    Route::resource('/brands', BrandsController::class);
    Route::get('/api/brands', [BrandsController::class, 'getBrandsJson']);

    //size
    Route::resource('/sizes', SizesController::class);
    Route::get('/api/sizes', [SizesController::class, 'getSizesJson']);

    //Product

    Route::resource('/products', ProductsController::class);
    Route::get('api/products', [ProductsController::class, 'getProductsJson']);
    //stock
    Route::get('/stocks', [StocksController::class, 'stock'])->name('stock');
    Route::post('/stocks', [StocksController::class, 'stockSubmit'])->name('stockSubmit');
    Route::get('/stocks/history', [StocksController::class, 'stockHistory'])->name('stockHistory');

    //return product
    Route::get('/return-products', [ReturnProductsController::class, 'returnProduct'])->name('returnProduct');
    Route::post('/return-products', [ReturnProductsController::class, 'returnProductSubmit'])->name('returnProductSubmit');
    Route::get('/return-products/history', [ReturnProductsController::class, 'history'])->name('returnProductHistory');
});

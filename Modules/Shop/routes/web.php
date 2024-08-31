<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\App\Http\Controllers\ShopController;

use Modules\Shop\App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'index'])->name('products.index');


Route::group([], function () {
    Route::resource('shop', ShopController::class)->names('shop');
});

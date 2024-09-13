<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\App\Http\Controllers\CartController;
use Modules\Shop\App\Http\Controllers\ShopController;
use Modules\Shop\App\Http\Controllers\OrderController;
use Modules\Shop\App\Http\Controllers\AddressController;

use Modules\Shop\App\Http\Controllers\PaymentController;
use Modules\Shop\App\Http\Controllers\ProductController;
use Modules\Shop\App\Http\Controllers\DashboardIndexController;
use Modules\Shop\App\Http\Controllers\DashboardProductController;

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

Route::get('/category/{categorySlug}', [ProductController::class, 'category'])->name('products.category');
Route::get('/tag/{tagSlug}', [ProductController::class, 'tag'])->name('products.tag');

Route::post('/payments/midtrans', [PaymentController::class, 'midtrans'])->name('payments.midtrans');
Route::get('/payments/success', [PaymentController::class, 'paymentSuccess'])->name('payments.success');


Route::middleware('auth')->group(function() {
  Route::get('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
  Route::post('/orders/checkout', [OrderController::class, 'store'])->name('orders.store');
  Route::post('/orders/shipping-fee', [OrderController::class, 'shippingFee'])->name('orders.shipping_fee');
  Route::post('/orders/choose-package', [OrderController::class, 'choosePackage'])->name('orders.choose-package');
  Route::get('/orders/list', [OrderController::class, 'orderList'])->name('orders.list');

  Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
  Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
  Route::get('/carts/{id}/remove', [CartController::class, 'destroy'])->name('carts.destroy');
  Route::put('/carts/', [CartController::class, 'update'])->name('carts.update');

});

Route::get('/{categorySlug}/{productSlug}', [ProductController::class, 'show'])->name('products.show');

Route::group([], function () {
    Route::resource('shop', ShopController::class)->names('shop');
});

Route::middleware('admin')->group(function() {
  Route::get('/dashboard', [DashboardIndexController::class, 'index'])->name('dashboards.index');

  Route::get('/dashboard/products/index', [DashboardProductController::class, 'index'])->name('dashboards_products.index');
  Route::post('/dashboard/products/{id}/publish', [DashboardProductController::class, 'publish'])->name('dashboards_products.publish');
  Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboards_products.create');
  Route::post('/dashboard/products/', [DashboardProductController::class, 'store'])->name('dashboards_products.store');
  // Route::post('/dashboard/create-product', [DashboardProductController::class, 'store'])->name('dashboard.product_store');
});

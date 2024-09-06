<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use Modules\Shop\App\Http\Controllers\AddressController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
  Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.index');
  Route::get('/profiles/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profiles/edit', [ProfileController::class, 'update'])->name('profile.update');
  
  Route::get('/addresses/edit/[id]', [AddressController::class, 'edit'])->name('address.edit');
  Route::patch('/addresses/edit', [AddressController::class, 'update'])->name('address.update');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


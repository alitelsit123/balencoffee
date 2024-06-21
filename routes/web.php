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

Route::middleware(['guest'])->group(function() {
  Route::get('login', [\App\Http\Controllers\AuthController::class, 'loginPage']);
  Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
  Route::get('register', [\App\Http\Controllers\AuthController::class, 'registerPage']);
  Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
});
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::get('/', \App\Livewire\Member::class);
Route::get('/products', \App\Livewire\Products::class);
Route::middleware(['auth'])->group(function() {
  Route::get('/profile', \App\Livewire\Profile::class);
  Route::get('/cart', \App\Livewire\Cart::class);
  Route::get('/invoice_detail/{id}', \App\Livewire\InvoiceDetail::class);
});

Route::prefix('admin')->group(function() {
  Route::get('/', \App\Livewire\Admin\Dashboard::class);
  Route::get('dashboard', \App\Livewire\Admin\Dashboard::class);
  Route::get('product', \App\Livewire\Admin\Product::class);
  Route::get('category', \App\Livewire\Admin\Category::class);
  Route::get('voucher', \App\Livewire\Admin\Voucher::class);
  Route::get('transaction', \App\Livewire\Admin\Transaction::class);
  Route::get('information', \App\Livewire\Admin\ShopInfo::class);
});

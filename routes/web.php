<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingController;

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

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::get('/product-search//', [\App\Http\Controllers\Products\ProductController::class, 'search'])->name('products.search');
Route::get('/product/{product:slug}', [\App\Http\Controllers\Products\ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    // Proceso de compra  
    Route::get('checkout-process/{data}', [ShoppingController::class, 'sendEmail'])
            ->name('sendEmail.checkout');

    Route::get('single-checkout/basic/', [ShoppingController::class, 'basicCheckout'])
            ->name('basic.checkout');
            
    Route::get('single-checkout/{product:slug}/{data}', [ShoppingController::class, 'singleShopping'])
            ->name('buy.single');

    Route::get('single-checkout/{product:slug}/payment/{data}', [ShoppingController::class, 'paymentSingleProduct'])
            ->name('pay.single');

    // user
    Route::get('my-orders/', function () {
        return view('user.orders');
    })->name('users.orders');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/productos', \App\Http\Livewire\Admin\Products\Index::class)->name('products');
        Route::get('/usuarios', \App\Http\Livewire\Admin\Users\Index::class)->name('users');
        Route::get('/ventas', \App\Http\Livewire\Admin\Orders\Index::class)->name('orders');
    });
});

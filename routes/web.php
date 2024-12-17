<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SellController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/buys', [BuyController::class, 'index'])->name('buys');
    Route::post('/buys/store', [BuyController::class, 'store'])->name('buys.store');
    Route::put('/buys/{buy}', [BuyController::class, 'update'])->name('buys.update');

    Route::get('/sells', [SellController::class, 'index'])->name('sells');
    Route::post('/sells/store', [SellController::class, 'store'])->name('sells.store');
    Route::put('/sells/{sell}', [SellController::class, 'update'])->name('sells.update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/sendcart', [CartController::class, 'sendcart'])->name('sendcart');

});

require __DIR__ . '/auth.php';

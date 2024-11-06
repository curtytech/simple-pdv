<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\SellController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::get('/buys', [BuyController::class, 'index'])->name('buys');
    Route::post('/buys/store', [BuyController::class, 'store'])->name('buys.store');
    Route::put('/buys/{buy}', [BuyController::class, 'update'])->name('buys.update');

    Route::get('/sells', [SellController::class, 'index'])->name('sells');
    Route::post('/sells/store', [SellController::class, 'store'])->name('sells.store');
    Route::put('/sells/{sell}', [SellController::class, 'update'])->name('sells.update');


});



require __DIR__.'/auth.php';

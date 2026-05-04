<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::get('/products', [FrontendProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [FrontendProductController::class, 'show'])->name('products.show');

// Cart
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});

// Cart Route (Alternatif)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/success/{orderNumber}', [CheckoutController::class, 'success'])->name('success');
});

// Orders (Authenticated only)
Route::middleware(['auth'])->prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [FrontendOrderController::class, 'index'])->name('index');
    Route::get('/{orderNumber}', [FrontendOrderController::class, 'show'])->name('show');
});

// Authentication Routes
Auth::routes();

// Redirect /home ke homepage
Route::get('/home', function () {
    return redirect('/');
});

// ========== TAMBAHKAN ROUTE LOGOUT MANUAL DI SINI ==========
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
// ===========================================================

// Admin Routes
require __DIR__ . '/admin.php';
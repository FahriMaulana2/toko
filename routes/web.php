<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES (FRONTEND)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');


// ==================== PRODUCTS ====================
Route::get('/products', [FrontendProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [FrontendProductController::class, 'show'])->name('products.show');


// ==================== CART ====================
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});


// ==================== CHECKOUT ====================
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/success/{orderNumber}', [CheckoutController::class, 'success'])->name('success');
});


// ==================== ORDERS (LOGIN REQUIRED) ====================
Route::middleware(['auth'])->prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [FrontendOrderController::class, 'index'])->name('index');
    Route::get('/{orderNumber}', [FrontendOrderController::class, 'show'])->name('show');
});


// ==================== AUTH (LOGIN, REGISTER, LOGOUT) ====================
Auth::routes();
// ⛔ JANGAN TAMBAH logout manual lagi (sudah ada dari Auth::routes)


// Redirect /home → /
Route::get('/home', function () {
    return redirect('/');
});


// ==================== ADMIN ROUTES ====================
require __DIR__ . '/admin.php';
<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ShipmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Brands
    Route::resource('brands', BrandController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Orders
    Route::resource('orders', OrderController::class);
    Route::put('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Payments
    Route::resource('payments', PaymentController::class);
    Route::post('payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::post('payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');

    // Shipments
    Route::resource('shipments', ShipmentController::class);
    Route::put('shipments/{shipment}/tracking', [ShipmentController::class, 'updateTracking'])->name('shipments.update-tracking');
    Route::post('shipments/{shipment}/shipped', [ShipmentController::class, 'markAsShipped'])->name('shipments.shipped');
    Route::post('shipments/{shipment}/delivered', [ShipmentController::class, 'markAsDelivered'])->name('shipments.delivered');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
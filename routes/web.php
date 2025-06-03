<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

// Chuyển hướng trang chủ vào dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Category routes
    Route::resource('categories', CategoryController::class);
    
    // Brand routes
    Route::resource('brands', BrandController::class);

    // Product routes
    Route::resource('products', ProductController::class);

    // Coupon routes
     Route::resource('coupons', CouponController::class);
});

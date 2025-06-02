<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;

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
});

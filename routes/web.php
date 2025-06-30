<?php

use App\Http\Controllers\Admin\BaiViet\NewsCategoryController;
use App\Http\Controllers\Admin\BaiViet\NewsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LienHeAdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\HomeController;

// Client routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);

    Route::resource('banners', BannerController::class);


    // Coupon routes
    Route::resource('coupons', CouponController::class);

    Route::resource('news', NewsController::class);
    Route::resource('news-categories', NewsCategoryController::class);

    // Route resource
    Route::resource('orders', OrderController::class);

    // Route cập nhật trạng thái đơn hàng (custom)
    Route::patch('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Quản lý liên hệ
    Route::get('lien-he', [LienHeAdminController::class, 'index'])->name('lienhe.index');
    Route::get('lien-he/{id}', [LienHeAdminController::class, 'show'])->name('lienhe.show');
    Route::delete('lien-he/{id}', [LienHeAdminController::class, 'destroy'])->name('lienhe.destroy');

    

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

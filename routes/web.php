<?php

use App\Http\Controllers\Admin\BaiViet\NewsCategoryController;
use App\Http\Controllers\Admin\BaiViet\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\ProductClientController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LienHeAdminController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [ProductClientController::class, 'index'])->name('client.products.index');

// trang chi tiết sản phẩm
Route::get('/products/{id}', [ProductClientController::class, 'show'])->name('client.products.show');


// Chuyển hướng trang chủ vào dashboard
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::post('/login', [AuthController::class, 'login']);

//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');



Route::middleware('admin')->group(function () {
    // Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
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



Route::resource('/users', UserController::class);

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

});

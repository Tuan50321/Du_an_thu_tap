<?php
use App\Http\Controllers\Client\Sanphamchitiet\ProductDetailController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductClientController;
use App\Http\Controllers\Client\Lienhe\LienHeController;
use App\Http\Controllers\Client\Baiviet\NewsController as BaivietNewsController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Lienhe\LienHeAdminController;
use App\Http\Controllers\Admin\BaiViet\NewsCategoryController;
use App\Http\Controllers\Admin\BaiViet\NewsController;

// ============================
// Public Auth Routes
// ============================

// Trang đăng nhập
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Trang đăng ký
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// ============================
// Client Routes
// ============================

Route::prefix('/')->name('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('search');

    // Liên hệ
    Route::resource('lienhe', LienHeController::class);

    // Sản phẩm
    Route::get('/products/{id}', [ProductClientController::class, 'show'])->name('products.show');

    // Tin tức
    Route::get('news', [BaivietNewsController::class, 'index'])->name('news.index');
    Route::get('news/{news}', [BaivietNewsController::class, 'show'])->name('news.show');
    Route::post('news/{news}/comment', [BaivietNewsController::class, 'comment'])->name('news.comment');

    Route::get('/product/{id}', [ProductDetailController::class, 'index'])->name('product.details');

});

// ============================
// Admin Routes (có middleware 'admin')
// ============================

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);


    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('news', NewsController::class);
    Route::resource('news-categories', NewsCategoryController::class);

    // Cập nhật trạng thái đơn hàng
    Route::patch('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Quản lý liên hệ
    Route::get('lien-he', [LienHeAdminController::class, 'index'])->name('lienhe.index');
    Route::get('lien-he/{id}', [LienHeAdminController::class, 'show'])->name('lienhe.show');
    Route::delete('lien-he/{id}', [LienHeAdminController::class, 'destroy'])->name('lienhe.destroy');

    // Laravel File Manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

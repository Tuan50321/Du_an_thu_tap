<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductClientController;
use App\Http\Controllers\Client\Contacts\ContactController;
use App\Http\Controllers\Client\News\NewsController as NewsNewsController;
use App\Http\Controllers\Client\ProductsShow\ProductDetailController;


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\News\NewsCategoryController as NewsNewsCategoryController;
use App\Http\Controllers\Admin\News\NewsCommentController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Client\ReviewsController;

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
    Route::resource('contacts', ContactController::class);

    // Sản phẩm
    Route::get('/products/{id}', [ProductClientController::class, 'show'])->name('products.show');

    // Tin tức
    Route::get('news', [NewsNewsController::class, 'index'])->name('news.index');
    Route::get('news/{news}', [NewsNewsController::class, 'show'])->name('news.show');
    Route::post('news/{news}/comment', [NewsNewsController::class, 'comment'])->name('news.comment');

    Route::get('/product/{id}', [ProductDetailController::class, 'index'])->name('product.details');

    // Danh mục - Hiển thị sản phẩm theo danh mục
    Route::get('/category/{slug}', [\App\Http\Controllers\Client\CategoryController::class, 'show'])->name('category.show');

    Route::resource('reviews', ReviewsController::class);
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

    Route::delete('/products/{product}/gallery/{index}', [ProductController::class, 'removeGalleryImage'])
        ->name('products.remove-gallery');
    Route::resource('brands', BrandController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('news', NewsController::class);
    Route::resource('news-categories', NewsNewsCategoryController::class);

    Route::get('/news-comments', [NewsCommentController::class, 'index'])->name('news-comments.index');
    Route::delete('/news-comments/{id}', [NewsCommentController::class, 'destroy'])->name('news-comments.destroy');
    Route::patch('/news-comments/{id}/toggle', [NewsCommentController::class, 'toggleVisibility'])->name('news-comments.toggle');



    // Quản lý đánh giá sản phẩm
    Route::resource('reviews', ReviewController::class);
    // Ẩn/hiện đánh giá
    Route::patch('reviews/{review}/toggle', [ReviewController::class, 'toggleVisibility'])->name('reviews.toggle');

    // Cập nhật trạng thái đơn hàng
    Route::patch('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Quản lý liên hệ
    Route::get('contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{id}', [ContactAdminController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{id}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');

    // Laravel File Manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
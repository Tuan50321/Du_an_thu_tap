<?php

use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\OrderClientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckPermission;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductClientController;
use App\Http\Controllers\Client\Contacts\ContactController;
use App\Http\Controllers\Client\News\NewsController as NewsNewsController;
use App\Http\Controllers\Client\ProductsShow\ProductDetailController;
use App\Http\Controllers\Client\CartController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\RoleController;
use App\Http\Controllers\Admin\Users\PermissionController;
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

    // Giỏ hàng
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [App\Http\Controllers\client\CartController::class, 'index'])->name('index');
        Route::post('/add', [App\Http\Controllers\client\CartController::class, 'add'])->name('add');
        Route::put('/{id}/update', [App\Http\Controllers\client\CartController::class, 'update'])->name('update');
        Route::delete('/{id}/remove', [App\Http\Controllers\client\CartController::class, 'remove'])->name('remove');
        Route::delete('/clear', [App\Http\Controllers\client\CartController::class, 'clear'])->name('clear');
        Route::post('/checkout', [App\Http\Controllers\client\CartController::class, 'checkout'])->name('checkout');
        Route::get('/count', [App\Http\Controllers\client\CartController::class, 'getCount'])->name('count');
        Route::get('/mini', [App\Http\Controllers\client\CartController::class, 'miniCart'])->name('mini');
    });

    // Trang thanh toán (phải đăng nhập)
    Route::middleware('auth')->group(function () {
        // Thanh toán
        Route::get('/thanh-toan', [CheckoutController::class, 'show'])->name('checkout');
        Route::post('/thanh-toan', [CheckoutController::class, 'store'])->name('checkout.store');

        // Đơn hàng của tôi (client)
        Route::get('/don-hang-cua-toi', [OrderClientController::class, 'index'])->name('orders.index');
        Route::get('/don-hang/{order}', [OrderClientController::class, 'show'])->name('orders.show');
        Route::patch('/don-hang/{order}/huy', [OrderClientController::class, 'cancel'])->name('orders.cancel');
        Route::delete('/don-hang/{order}', [OrderClientController::class, 'destroy'])
        ->name('orders.destroy');
    });

    Route::resource('reviews', ReviewsController::class);
});

// Shopping Cart routes theo mẫu mới
Route::post('/shopping-cart/add', [App\Http\Controllers\Client\CartController::class, 'addToCart'])->name('shopping-cart.add');
Route::get('/shopping-cart/count', [App\Http\Controllers\Client\CartController::class, 'getCartCount'])->name('shopping-cart.count');
Route::delete('/shopping-cart/remove/{itemId}', [App\Http\Controllers\Client\CartController::class, 'removeFromCart'])->name('shopping-cart.remove');
Route::put('/shopping-cart/update/{item}', [App\Http\Controllers\Client\CartController::class, 'update'])->name('shopping-cart.update');

// Profile routes
Route::prefix('profile')->name('client.profile.')->group(function () {
    Route::get('/', [App\Http\Controllers\Client\ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [App\Http\Controllers\Client\ProfileController::class, 'update'])->name('update');
    Route::get('/password', [App\Http\Controllers\Client\ProfileController::class, 'password'])->name('password');
    Route::post('/update-password', [App\Http\Controllers\Client\ProfileController::class, 'updatePassword'])->name('update-password');
});

// Thanh toán Momo
Route::get('/payment/momo/callback', [CheckoutController::class, 'momoCallback'])->name('payment.momo.callback');


// ============================
// Admin Routes (có middleware 'admin')
// ============================

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    


    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::delete('/products/{product}/gallery/{index}', [ProductController::class, 'removeGalleryImage'])
        ->name('products.remove-gallery');
    Route::resource('brands', BrandController::class)->parameters([
        'brands' => 'brand_id'
    ]);
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

    Route::prefix('users')->name('users.')->group(function () {
        // Danh sách người dùng chung + tìm kiếm
        Route::get('/', [UserController::class, 'index'])->name('index');

        // Danh sách chia theo vai trò
        Route::get('/admins', [UserController::class, 'admins'])->name('admins');
        Route::get('/staffs', [UserController::class, 'staffs'])->name('staffs');
        Route::get('/customers', [UserController::class, 'customers'])->name('customers');

        // Thêm, sửa, xóa người dùng
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

        // Thùng rác, khôi phục, xóa vĩnh viễn
        Route::get('/trashed', [UserController::class, 'trashed'])->name('trashed');
        Route::post('/{id}/restore', [UserController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [UserController::class, 'forceDelete'])->name('forceDelete');

        // Quản lý địa chỉ người dùng
        Route::get('/{user}/addresses', [UserController::class, 'addresses'])->name('addresses.index');
        Route::post('/{user}/addresses', [UserController::class, 'addAddress'])->name('addresses.store');
        Route::put('/addresses/{address}', [UserController::class, 'updateAddress'])->name('addresses.update');
        Route::delete('/addresses/{address}', [UserController::class, 'deleteAddress'])->name('addresses.destroy');
    });

    // =================== ROLES MANAGEMENT (chỉ admin) ===================
    Route::prefix('roles')->name('roles.')->group(function () {
        // Thùng rác, khôi phục, xóa vĩnh viễn
        Route::get('trashed', [RoleController::class, 'trashed'])->name('trashed');
        Route::post('{id}/restore', [RoleController::class, 'restore'])->name('restore');
        Route::delete('{id}/force-delete', [RoleController::class, 'forceDelete'])->name('force-delete');

        // Danh sách roles riêng (ví dụ dùng để phân trang)
        Route::get('list', [RoleController::class, 'list'])->name('list');

        // ✅ Gán vai trò cho người dùng
        Route::post('update-users', [RoleController::class, 'updateUsers'])->name('updateUsers');

        // Gán quyền cho vai trò
        Route::middleware(CheckPermission::class . ':assign_permission')
            ->get('{role}/permissions', [PermissionController::class, 'permissions'])->name('permissions.edit');
        Route::middleware(CheckPermission::class . ':assign_permission')
            ->put('{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('permissions.update');

        // CRUD tài nguyên chính (nên để sau cùng để tránh override)
        Route::resource('/', RoleController::class)->parameters(['' => 'role']);
    });



    Route::prefix('permissions')->name('permissions.')->group(function () {
        // Xem danh sách quyền (dạng ma trận + danh sách phân trang)
        Route::middleware(CheckPermission::class . ':view_permission')
            ->get('/', [PermissionController::class, 'index'])->name('index');
        Route::middleware(CheckPermission::class . ':view_permission')
            ->get('/list', [PermissionController::class, 'list'])->name('list');

        // Thêm quyền
        Route::middleware(CheckPermission::class . ':create_permission')
            ->get('/create', [PermissionController::class, 'create'])->name('create');
        Route::middleware(CheckPermission::class . ':create_permission')
            ->post('/', [PermissionController::class, 'store'])->name('store');

        // Sửa quyền
        Route::middleware(CheckPermission::class . ':edit_permission')
            ->get('/{permission}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::middleware(CheckPermission::class . ':edit_permission')
            ->put('/{permission}', [PermissionController::class, 'update'])->name('update');

        // Xoá mềm quyền
        Route::middleware(CheckPermission::class . ':delete_permission')
            ->delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');

        // Gán quyền cho vai trò (từ bảng ma trận)
        Route::middleware(CheckPermission::class . ':assign_permission')
            ->post('/update-roles', [PermissionController::class, 'updateRoles'])->name('updateRoles');

        // 📦 Thùng rác - quyền đã xoá mềm
        Route::middleware(CheckPermission::class . ':delete_permission')
            ->get('/trashed', [PermissionController::class, 'trashed'])->name('trashed');

        Route::middleware(CheckPermission::class . ':delete_permission')
            ->post('/{id}/restore', [PermissionController::class, 'restore'])->name('restore');

        Route::middleware(CheckPermission::class . ':delete_permission')
            ->delete('/{id}/force-delete', [PermissionController::class, 'forceDelete'])->name('forceDelete');
    });
    // Laravel File Manager
    // Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    //     \UniSharp\LaravelFilemanager\Lfm::routes();
    // });


});
    Route::post('/chatbot/send', [ChatbotController::class, 'send']);

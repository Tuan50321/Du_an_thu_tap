<?php $__env->startSection('title', 'Trang chủ - HOUSE HOLD GOOD'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Banner Carousel -->
    <?php if($banners->count() > 0): ?>
        <section class="banner-carousel">
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="<?php echo e($index); ?>"
                            class="<?php echo e($index == 0 ? 'active' : ''); ?>"></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="carousel-inner">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($banner->is_active): ?>
                            <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                <?php if($banner->link_url): ?>
                                    <a href="<?php echo e($banner->link_url); ?>" target="_blank">
                                        <img src="<?php echo e($banner->image_url_full); ?>" class="d-block w-100" alt="Banner">
                                    </a>
                                <?php else: ?>
                                    <img src="<?php echo e($banner->image_url_full); ?>" class="d-block w-100" alt="Banner">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>
    <?php endif; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Chào mừng đến với <span style="color:#ff9900">HOUSE HOLD GOOD</span>
                    </h1>
                    <p class="lead mb-4">Chuyên cung cấp các sản phẩm <b>đồ gia dụng</b> chất lượng cao, an toàn và tiện ích
                        cho mọi gia đình Việt. Khám phá hàng ngàn sản phẩm từ nồi chảo, bếp điện, máy lọc nước, thiết bị nhà
                        bếp, đồ dùng phòng tắm, vệ sinh, chăm sóc nhà cửa... với giá tốt nhất!</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-light btn-lg">Khám phá ngay</a>
                        <a href="#" class="btn btn-outline-light btn-lg">Tư vấn miễn phí</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <?php if($banners->count() > 0): ?>
                        <img src="<?php echo e($banners->first()->image_url_full); ?>" alt="Banner" class="img-fluid rounded shadow">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/600x400?text=No+Banner" alt="No Banner"
                            class="img-fluid rounded shadow">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Danh mục đồ gia dụng</h2>
                    <p class="text-muted">Chọn nhanh sản phẩm theo nhu cầu gia đình bạn</p>
                </div>
            </div>
            <div class="row g-4">
                <?php $__currentLoopData = $categories->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 col-lg-2">
                        <div class="category-card">
                            <i class="fas fa-couch fa-3x mb-3"></i>
                            <h5><?php echo e($category->name); ?></h5>
                            <small><?php echo e($category->products_count ?? 0); ?> sản phẩm</small>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <?php if(isset($query)): ?>
                        <h2 class="fw-bold">Kết quả tìm kiếm cho: "<?php echo e($query); ?>"</h2>
                        <p class="text-muted">Tìm thấy <?php echo e($products->count()); ?> sản phẩm</p>
                    <?php else: ?>
                        <h2 class="fw-bold">Sản phẩm gia dụng nổi bật</h2>
                        <p class="text-muted">Những sản phẩm được khách hàng tin dùng và đánh giá cao</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row g-4">
                <?php
                    $listProducts = isset($products) ? $products : $featuredProducts;
                ?>
                <?php $__currentLoopData = $listProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($product->status === 'active'): ?>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card product-card h-100">
                                <a href="<?php echo e(route('client.product.details', ['id' => $product->product_id])); ?>">
                                    <img src="<?php echo e($product->thumbnail_url); ?>" class="card-img-top product-image"
                                        alt="<?php echo e($product->name); ?>"></a>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?php echo e($product->name); ?></h6>
                                    <p class="card-text text-muted small"><?php echo e(Str::limit($product->description, 100)); ?></p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-danger fw-bold"><?php echo e(number_format($product->price)); ?>

                                                VNĐ</span>
                                            <?php if($product->old_price): ?>
                                                <span
                                                    class="text-muted text-decoration-line-through"><?php echo e(number_format($product->old_price)); ?>

                                                    VNĐ</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <form method="POST" class="add-to-cart-form w-100">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="price" value="<?php echo e($product->discount_price ?? $product->price); ?>">
                                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                                    <i class="fas fa-shopping-cart me-1"></i> Thêm vào giỏ hàng
                                                </button>
                                            </form>
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <?php if(!isset($query)): ?>
                        <a href="#" class="btn btn-primary btn-lg">Xem tất cả sản phẩm gia dụng</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Thương hiệu gia dụng uy tín</h2>
                    <p class="text-muted">Chúng tôi phân phối sản phẩm chính hãng từ các thương hiệu nổi tiếng</p>
                </div>
            </div>
            <style>
                .brand-card {
                    background: linear-gradient(135deg, #f8fafc 60%, #e0e7ff 100%);
                    border-radius: 18px;
                    box-shadow: 0 4px 18px 0 rgba(60, 72, 88, 0.10);
                    transition: transform 0.2s, box-shadow 0.2s;
                    padding: 24px 10px 16px 10px;
                    min-height: 140px;
                    position: relative;
                }

                .brand-card:hover {
                    transform: translateY(-6px) scale(1.04);
                    box-shadow: 0 8px 32px 0 rgba(60, 72, 88, 0.18);
                    background: linear-gradient(135deg, #e0e7ff 60%, #c7d2fe 100%);
                }

                .brand-card .fa-industry {
                    color: #6366f1;
                    text-shadow: 0 2px 8px #c7d2fe;
                }

                .brand-card h6 {
                    color: #374151;
                    font-weight: 600;
                    letter-spacing: 0.5px;
                    margin-top: 10px;
                }
            </style>
            <div class="row g-4 align-items-center">
                <?php $__currentLoopData = $brands->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-2 col-6 text-center">
                        <div class="brand-card">
                            <?php if($brand->logo): ?>
                                <img src="<?php echo e(asset('storage/' . $brand->logo)); ?>" alt="<?php echo e($brand->name); ?>"
                                    class="img-fluid mb-2"
                                    style="max-height: 60px; filter: drop-shadow(0 2px 8px #6366f1aa);">
                            <?php else: ?>
                                <i class="fas fa-industry fa-3x mb-2"></i>
                            <?php endif; ?>
                            <div>
                                <h6 class="mb-0"><?php echo e($brand->name); ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <?php if($latestNews->count() > 0): ?>
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="fw-bold">Tin tức & Mẹo vặt gia đình</h2>
                        <p class="text-muted">Cập nhật xu hướng, kinh nghiệm sử dụng đồ gia dụng thông minh</p>
                    </div>
                </div>
                <div class="row g-4">
                    <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="card news-card h-100">
                                <img src="<?php echo e(asset($news->image)); ?>" class="card-img-top" alt="<?php echo e($news->title); ?>"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo e($news->title); ?></h6>
                                    <p class="card-text text-muted">
                                        <?php echo e(Str::limit($news->summary ?? $news->content, 120)); ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                       <small class="text-muted">
                                        <?php echo e($news->created_at ? \Carbon\Carbon::parse($news->created_at)->format('d/m/Y') : 'N/A'); ?>

                                        </small>
                                        <a href="<?php echo e(route('client.news.show', $news->news_id)); ?>"
                                            class="btn btn-outline-primary btn-sm">
                                            Xem chi tiết
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
                        <h5>Giao hàng toàn quốc</h5>
                        <p class="text-muted">Nhanh chóng - An toàn - Đúng hẹn</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                        <h5>Bảo hành chính hãng</h5>
                        <p class="text-muted">Cam kết 100% sản phẩm chính hãng, bảo hành dài hạn</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <i class="fas fa-undo fa-3x text-primary mb-3"></i>
                        <h5>Đổi trả dễ dàng</h5>
                        <p class="text-muted">Đổi trả miễn phí trong 7 ngày nếu sản phẩm lỗi</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                        <h5>Hỗ trợ tận tâm</h5>
                        <p class="text-muted">Tư vấn miễn phí, hỗ trợ 24/7 mọi thắc mắc của bạn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="toast-container" id="toastContainer" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('#bannerCarousel').carousel({
                interval: 5000
            });

            $('.add-to-cart-form').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                let btn = form.find('button');
                let originalText = btn.html();

                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang thêm...');

                $.ajax({
                    url: "<?php echo e(route('client.cart.add')); ?>",
                    method: 'POST',
                    data: form.serialize(),
                    success: function (res) {
                        if (res.success) {
                            showToast('🛒 Đã thêm vào giỏ hàng!', 'success');
                            $('.cart-count').text(res.cart_count ?? 0);
                        } else {
                            showToast(res.message || '❌ Có lỗi xảy ra!', 'danger');
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            showToast('⚠️ Vui lòng đăng nhập để thêm vào giỏ hàng.', 'warning');
                            setTimeout(() => {
                                window.location.href = "<?php echo e(route('login')); ?>";
                            }, 1500);
                        } else {
                            showToast('❌ Thêm sản phẩm vào giỏ thất bại!', 'danger');
                        }
                    },
                    complete: function () {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });

        function showToast(message, type = 'success') {
            const toastEl = document.getElementById('liveToast');
            const toastMsg = document.getElementById('toast-message');

            toastEl.className = `toast align-items-center text-bg-${type} border-0`;
            toastMsg.textContent = message;

            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    </script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laragon\www\Du_an_thu_tap\resources\views/client/home.blade.php ENDPATH**/ ?>
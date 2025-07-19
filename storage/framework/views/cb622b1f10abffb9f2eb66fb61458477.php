<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            min-width: 300px;
            margin-bottom: 10px;
        }

        .toast-success {
            background-color: #6c757d;
            border-color: #5a6268;
            color: #ffffff;
        }

        .toast-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white p-2 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
            </ol>
        </nav>

        
        <div class="row mt-4">
            <div class="col-md-6">
                <img src="<?php echo e(asset('storage/' . $product->thumbnail)); ?>" class="img-fluid rounded shadow-sm"
                    alt="<?php echo e($product->name); ?>">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3"><?php echo e($product->name); ?></h2>
                <p class="text-muted mb-2">Thương hiệu: <?php echo e($product->brand->name ?? 'N/A'); ?></p>
                <p class="mb-3">Danh mục: <?php echo e($product->category->name ?? 'N/A'); ?></p>
                <p class="mb-3">Số lượng còn lại: <span class="badge bg-info"><?php echo e($product->stock); ?></span></p>
                <h4 class="text-danger fw-bold mb-3">
                    <?php echo e(number_format($product->discount_price ?? $product->price, 0, ',', '.')); ?>₫
                </h4>

                
                <div class="mb-3" style="width: 120px;">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo e($product->stock); ?>"
                        class="form-control" id="quantityDisplay">
                </div>

                
                <form method="POST" action="<?php echo e(route('client.cart.add')); ?>" class="add-to-cart-form mt-3"
                    id="addToCartForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">
                    <input type="hidden" name="quantity" value="1" id="quantityInput">
                    <input type="hidden" name="price" value="<?php echo e($product->discount_price ?? $product->price); ?>">
                    <?php if($product->stock <= 0): ?>
                        <button type="button" class="btn btn-secondary" disabled>
                            <i class="fa fa-shopping-cart"></i> Hết hàng
                        </button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary" id="addToCartBtn">
                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                        </button>
                    <?php endif; ?>
                </form>

                
                <script>
                    $(document).ready(function() {
                        // Cập nhật số lượng khi thay đổi
                        $('#quantityDisplay').on('change', function() {
                            $('#quantityInput').val($(this).val());
                        });

                        // Xử lý form thêm vào giỏ hàng
                        $('#addToCartForm').on('submit', function(e) {
                            e.preventDefault();

                            var form = $(this);
                            var btn = $('#addToCartBtn');
                            var originalText = btn.html();

                            // Disable button và hiển thị loading
                            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang thêm...');

                            $.ajax({
                                url: form.attr('action'),
                                method: 'POST',
                                data: form.serialize(),
                                success: function(response) {
                                    if (response.success) {
                                        showToast('success', 'Đã thêm sản phẩm vào giỏ hàng');
                                        // Reset form
                                        $('#quantityDisplay').val(1);
                                        $('#quantityInput').val(1);
                                        // Cập nhật số lượng giỏ hàng
                                        updateCartCount(response.cart_count);
                                    } else {
                                        showToast('error', response.message ||
                                            'Có lỗi xảy ra khi thêm sản phẩm');
                                    }
                                },
                                error: function(xhr) {
                                    showToast('error', xhr.responseJSON ? xhr.responseJSON.message :
                                        'Có lỗi xảy ra');
                                },
                                complete: function() {
                                    // Enable button và khôi phục text
                                    btn.prop('disabled', false).html(originalText);
                                }
                            });
                        });
                    });

                    // Hàm hiển thị toast
                    function showToast(type, message) {
                        var toastClass = type === 'success' ? 'toast-success' : 'toast-error';
                        var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

                        var toast = `
                        <div class="toast ${toastClass} border-0 shadow" role="alert" style="display: block;">
                            <div class="toast-header">
                                <i class="fa ${icon} me-2"></i>
                                <strong class="me-auto">${type === 'success' ? 'Thành công' : 'Lỗi'}</strong>
                                <button type="button" class="btn-close" onclick="$(this).closest('.toast').remove()"></button>
                            </div>
                            <div class="toast-body">
                                ${message}
                            </div>
                        </div>
                    `;

                        $('#toastContainer').append(toast);

                        setTimeout(function() {
                            $('.toast').fadeOut(function() {
                                $(this).remove();
                            });
                        }, 3000);
                    }

                    // Cập nhật số lượng giỏ hàng
                    function updateCartCount(count) {
                        $('.cart-count').text(count);
                    }
                </script>

                
                <div class="mt-4">
                    <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
                    <div class="p-3 rounded bg-light shadow-sm" style="line-height: 1.7;">
                        <?php echo nl2br(
                            e($product->description ?: 'Sản phẩm chất lượng cao, thiết kế tinh tế, đáp ứng nhu cầu sử dụng hàng ngày của bạn.'),
                        ); ?>

                    </div>
                </div>
            </div>
        </div>

        
        <!-- Form đánh giá -->
        <div class="mt-4 p-4 rounded border shadow-sm bg-white">
            <h5 class="fw-bold mb-3">Đánh giá sản phẩm</h5>
            <form action="<?php echo e(route('client.reviews.store')); ?>" method="POST" class="rating-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">

                <div class="star-rating mb-3">
                    <?php for($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" id="star<?php echo e($i); ?>" name="rating" value="<?php echo e($i); ?>">
                        <label for="star<?php echo e($i); ?>" title="<?php echo e($i); ?> sao">&#9733;</label>
                    <?php endfor; ?>
                </div>

                <textarea name="content" class="form-control mb-3 rounded" rows="4"
                    placeholder="Hãy để lại bình luận của bạn tại đây!" required></textarea>

                <button type="submit" class="btn btn-danger rounded px-4">Gửi đánh giá</button>
            </form>
        </div>

        <!-- Hiển thị đánh giá đã có -->
        <div class="mt-5 p-4 rounded border bg-white shadow-sm">
            <h5 class="fw-bold mb-3">Đánh giá của khách hàng</h5>

            <?php
                $reviews = $product->reviews()->where('is_approved', 1)->latest()->get();
                $reviewCount = $reviews->count();
                $avgRating = $reviewCount ? round($reviews->avg('rating'), 1) : 0;
            ?>

            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <span class="fs-1 fw-bold text-warning"><?php echo e($avgRating); ?></span>
                    <span class="text-muted">/ 5</span>
                </div>
                <div>
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <i class="fa<?php echo e($i <= $avgRating ? 's' : 'r'); ?> fa-star text-warning"></i>
                    <?php endfor; ?>
                    <div class="text-muted small"><?php echo e($reviewCount); ?> lượt đánh giá</div>
                </div>
            </div>

            <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border-top pt-3 mt-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <strong><?php echo e($review->user->name ?? 'Khách'); ?></strong>
                        <span class="text-muted small"><?php echo e($review->created_at->format('d/m/Y')); ?></span>
                    </div>
                    <div class="mb-2">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="fa<?php echo e($i <= $review->rating ? 's' : 'r'); ?> fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="mb-0"><?php echo e($review->content); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted">Chưa có đánh giá nào.</p>
            <?php endif; ?>
        </div>


        
        <?php if($relatedProducts->isNotEmpty()): ?>
            <div class="mt-5">
                <h4 class="fw-bold mb-3">Sản phẩm liên quan</h4>
                <div class="row row-cols-2 row-cols-md-4 g-4">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <a href="<?php echo e(route('client.product.details', $related->product_id)); ?>">
                                    <img src="<?php echo e(asset('storage/' . $related->thumbnail)); ?>" class="card-img-top"
                                        alt="<?php echo e($related->name); ?>" style="object-fit: cover; height: 200px;">
                                </a>
                                <div class="card-body p-2">
                                    <h6 class="card-title mb-1 text-truncate"><?php echo e($related->name); ?></h6>
                                    <p class="text-danger fw-bold mb-1">
                                        <?php echo e(number_format($related->discount_price ?? $related->price, 0, ',', '.')); ?>₫
                                    </p>
                                    <a href="<?php echo e(route('client.product.details', $related->product_id)); ?>"
                                        class="btn btn-sm btn-outline-primary w-100">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<div class="toast-container" id="toastContainer"></div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Cập nhật số lượng khi người dùng thay đổi
            $('#quantityDisplay').on('change', function() {
                $('#quantityInput').val($(this).val());
            });

            // Xử lý form thêm vào giỏ hàng
            $('#addToCartForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var btn = $('#addToCartBtn');
                var originalText = btn.html();

                // Disable button và hiển thị loading
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang thêm...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', 'Đã thêm sản phẩm vào giỏ hàng');
                            // Reset form
                            $('#quantityDisplay').val(1);
                            $('#quantityInput').val(1);
                            // Cập nhật số lượng giỏ hàng
                            if (response.cart_count !== undefined) {
                                updateCartCount(response.cart_count);
                            }
                        } else {
                            showToast('error', response.message ||
                                'Có lỗi xảy ra khi thêm sản phẩm');
                        }
                    },
                    error: function(xhr) {
                        var message = 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        showToast('error', message);
                    },
                    complete: function() {
                        // Enable button và khôi phục text
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Hàm hiển thị toast
            function showToast(type, message) {
                var toastClass = type === 'success' ? 'toast-success' : 'toast-error';
                var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

                var toast = `
            <div class="toast ${toastClass} border-0 shadow" role="alert" style="display: block;">
                <div class="toast-header">
                    <i class="fa ${icon} me-2"></i>
                    <strong class="me-auto">${type === 'success' ? 'Thành công' : 'Lỗi'}</strong>
                    <button type="button" class="btn-close" onclick="$(this).closest('.toast').remove()"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;

                $('#toastContainer').append(toast);

                // Tự động ẩn sau 3 giây
                setTimeout(function() {
                    $('.toast').fadeOut(function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/product-details/index.blade.php ENDPATH**/ ?>
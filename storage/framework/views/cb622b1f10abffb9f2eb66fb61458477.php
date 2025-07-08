<?php $__env->startSection('content'); ?>
    <div class="container py-4">

        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white p-2 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
            </ol>
        </nav>

        
        <div class="row mt-4">
            <div class="col-md-5">
                <img src="<?php echo e(asset('storage/' . $product->thumbnail)); ?>" class="img-fluid rounded shadow-sm w-100"
                    alt="<?php echo e($product->name); ?>">
            </div>
            <div class="col-md-7">
                <h1 class="fw-bold mb-3"><?php echo e($product->name); ?></h1>
                <p class="text-muted mb-1">Thương hiệu: <strong><?php echo e($product->brand->name ?? 'N/A'); ?></strong></p>
                <p class="mb-3">Danh mục: <strong><?php echo e($product->category->name ?? 'N/A'); ?></strong></p>

                <div class="mb-3">
                    <h3 class="text-danger fw-bold">
                        <?php echo e(number_format($product->discount_price ?? $product->price, 0, ',', '.')); ?>₫
                    </h3>
                </div>

                
                <div class="row g-2">
                    <?php if($colors->isNotEmpty()): ?>
                        <div class="col-6">
                            <label class="form-label">Màu sắc:</label>
                            <select class="form-select">
                                <option>Chọn màu</option>
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e(ucfirst($color)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if($materials->isNotEmpty()): ?>
                        <div class="col-6">
                            <label class="form-label">Chất liệu:</label>
                            <select class="form-select">
                                <option>Chọn chất liệu</option>
                                <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e(ucfirst($material)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control"
                        style="width: 120px;">
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary w-50">
                        <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                    </button>
                    <button class="btn btn-danger w-50">
                        <i class="fas fa-bolt"></i> Mua ngay
                    </button>
                </div>
            </div>
        </div>

        
        <div class="mt-5">
            <h4 class="fw-bold">Mô tả sản phẩm</h4>
            <div class="bg-light rounded p-3 shadow-sm">
                <?php echo nl2br(e($product->description ?: 'Không có mô tả chi tiết.')); ?>

            </div>
        </div>

        
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Đánh giá từ người dùng</h4>

            <?php
                $approvedReviews = $product->reviews->where('is_approved', true)->sortByDesc('created_at');
            ?>


            <?php if($approvedReviews->isEmpty()): ?>
                <div class="alert alert-info">Chưa có đánh giá nào cho sản phẩm này.</div>
            <?php else: ?>
                <div class="list-group">
                    <?php $__currentLoopData = $approvedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item mb-2 rounded shadow-sm">
                            <div class="d-flex justify-content-between">
                                <strong><?php echo e($review->user->name ?? 'Ẩn danh'); ?></strong>
                                <small><?php echo e($review->created_at->format('d/m/Y H:i')); ?></small>
                            </div>
                            <div>
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i class="<?php echo e($i <= $review->rating ? 'fas' : 'far'); ?> fa-star text-warning"></i>
                                <?php endfor; ?>
                            </div>
                            <p><?php echo e($review->content); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            
            <?php if(auth()->guard()->check()): ?>
                <div class="card mt-4">
                    <div class="card-header">Gửi đánh giá của bạn</div>
                    <div class="card-body">
                        <form action="<?php echo e(route('client.reviews.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->product_id); ?>">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Đánh giá của bạn <span class="text-danger">*</span></label>
                                <div class="star-rating d-flex gap-1">
                                    <?php for($i = 5; $i >= 1; $i--): ?>
                                        <input type="radio" name="rating" value="<?php echo e($i); ?>"
                                            id="star<?php echo e($i); ?>">
                                        <label for="star<?php echo e($i); ?>"><i class="fa fa-star"></i></label>
                                    <?php endfor; ?>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Nội dung:</label>
                                <textarea name="content" class="form-control" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-4">
                    Vui lòng <a href="<?php echo e(route('login')); ?>">đăng nhập</a> để gửi đánh giá.
                </div>
            <?php endif; ?>
        </div>

        
        <?php if($relatedProducts->isNotEmpty()): ?>
            <div class="mt-5">
                <h4 class="fw-bold">Sản phẩm liên quan</h4>
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <a href="<?php echo e(route('client.product.details', $related->product_id)); ?>">
                                    <img src="<?php echo e(asset('storage/' . $related->thumbnail)); ?>" class="card-img-top"
                                        alt="<?php echo e($related->name); ?>" style="height: 200px; object-fit: cover;">
                                </a>
                                <div class="card-body p-2">
                                    <h6 class="card-title text-truncate"><?php echo e($related->name); ?></h6>
                                    <p class="text-danger fw-bold">
                                        <?php echo e(number_format($related->discount_price ?? $related->price, 0, ',', '.')); ?>₫
                                    </p>
                                    <a href="<?php echo e(route('client.product.details', $related->product_id)); ?>"
                                        class="btn btn-sm btn-outline-primary w-100">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/product-details/index.blade.php ENDPATH**/ ?>
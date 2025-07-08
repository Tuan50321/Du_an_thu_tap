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
                <h4 class="text-danger fw-bold mb-3">
                    <?php echo e(number_format($product->discount_price ?? $product->price, 0, ',', '.')); ?>₫
                </h4>

                
                <?php if($rams->isNotEmpty()): ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn RAM:</label>
                        <select class="form-select" name="ram">
                            <option value="">Chọn RAM</option>
                            <?php $__currentLoopData = $rams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ram); ?>"><?php echo e($ram); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>

                
                <?php if($roms->isNotEmpty()): ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn ROM:</label>
                        <select class="form-select" name="rom">
                            <option value="">Chọn ROM</option>
                            <?php $__currentLoopData = $roms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rom); ?>"><?php echo e($rom); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>

                
                <?php if($colors->isNotEmpty()): ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn màu:</label>
                        <select class="form-select" name="color">
                            <option value="">Chọn màu</option>
                            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($color); ?>"><?php echo e(ucfirst($color)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>

                
                <?php if($materials->isNotEmpty()): ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn chất liệu:</label>
                        <select class="form-select" name="material">
                            <option value="">Chọn chất liệu</option>
                            <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($material); ?>"><?php echo e(ucfirst($material)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>

                
                <div class="mb-3" style="width: 120px;">
                    <input type="number" name="quantity" value="1" min="1" class="form-control">
                </div>

                 
                <div class="mt-4">
                    <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
                    <div class="p-3 rounded bg-light shadow-sm" style="line-height: 1.7;">
                        <?php echo nl2br(e($product->description ?: 'Sản phẩm chất lượng cao, thiết kế tinh tế, đáp ứng nhu cầu sử dụng hàng ngày của bạn.')); ?>

                    </div>
                </div>
                <br>

                
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-bolt"></i> Mua ngay
                    </button>
                </div>
            </div>
        </div>

    </div>

        
    <?php if($relatedProducts->isNotEmpty()): ?>
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Sản phẩm liên quan</h4>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <a href="<?php echo e(route('client.product.details', $related->product_id)); ?>">
                                <img src="<?php echo e(asset('storage/' . $related->thumbnail)); ?>"
                                     class="card-img-top"
                                     alt="<?php echo e($related->name); ?>"
                                     style="object-fit: cover; height: 200px;">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/client/product-details/index.blade.php ENDPATH**/ ?>
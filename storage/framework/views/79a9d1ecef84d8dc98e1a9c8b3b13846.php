<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row">
        <!-- Sidebar filter -->
        <div class="col-md-3 mb-4">
            <form method="GET" action="">
                <div class="card mb-3">
                    <div class="card-header">Lọc theo giá</div>
                    <div class="card-body">
                        <?php
                            $priceRanges = [
                                ['label' => 'Dưới 200.000đ', 'min' => 0, 'max' => 200000],
                                ['label' => '200.000đ - 500.000đ', 'min' => 200000, 'max' => 500000],
                                ['label' => '500.000đ - 1.000.000đ', 'min' => 500000, 'max' => 1000000],
                                ['label' => 'Trên 1.000.000đ', 'min' => 1000000, 'max' => null],
                            ];
                            $selectedRange = null;
                            foreach ($priceRanges as $i => $range) {
                                if (request('min_price') == $range['min'] && request('max_price') == $range['max']) {
                                    $selectedRange = $i;
                                }
                            }
                        ?>
                        <?php $__currentLoopData = $priceRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price_range" id="price_range_<?php echo e($i); ?>" value="<?php echo e($i); ?>"
                                    <?php if($selectedRange === $i): ?> checked <?php endif; ?>
                                    onclick="
                                        document.querySelector('[name=min_price]').value = '<?php echo e($range['min']); ?>';
                                        document.querySelector('[name=max_price]').value = '<?php echo e($range['max'] ?? ''); ?>';
                                        this.form.submit();
                                    ">
                                <label class="form-check-label" for="price_range_<?php echo e($i); ?>"><?php echo e($range['label']); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <input type="hidden" name="min_price" value="<?php echo e(request('min_price')); ?>">
                        <input type="hidden" name="max_price" value="<?php echo e(request('max_price')); ?>">
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">Thương hiệu</div>
                    <div class="card-body">
                        <select name="brand_id" class="form-select">
                            <option value="">Tất cả</option>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->brand_id); ?>" <?php echo e(request('brand_id') == $brand->brand_id ? 'selected' : ''); ?>><?php echo e($brand->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </form>
        </div>
        <!-- Product list -->
        <div class="col-md-9">
            <h3 class="mb-4">Danh mục: <?php echo e($category->name); ?></h3>
            <div class="row g-3">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4 col-6">
                        <div class="card product-card h-100">
                            <img src="<?php echo e($product->thumbnail_url); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                <p class="card-text mb-1">
                                    <span class="fw-bold text-danger"><?php echo e(number_format($product->display_price, 0, ',', '.')); ?> đ</span>
                                    <?php if($product->is_discounted): ?>
                                        <span class="text-muted text-decoration-line-through ms-2"><?php echo e(number_format($product->price, 0, ',', '.')); ?> đ</span>
                                    <?php endif; ?>
                                </p>
                                <p class="mb-0"><small>Thương hiệu: <?php echo e($product->brand->name ?? 'Không rõ'); ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info">Không có sản phẩm nào phù hợp.</div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mt-4">
                <?php echo e($products->withQueryString()->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .product-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .product-card .card-img-top {
        height: 220px;
        object-fit: cover;
        background: #f8f9fa;
    }
    .product-card .card-body {
        flex: 1 1 auto;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
</style>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/client/categories/category.blade.php ENDPATH**/ ?>
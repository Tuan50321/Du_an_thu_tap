<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết sản phẩm</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Thông tin cơ bản -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Thông tin cơ bản</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Mã sản phẩm</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->product_id); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Tên sản phẩm</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->name); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Danh mục</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->category->name ?? ''); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Thương hiệu</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->brand->name ?? ''); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Giá</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e(number_format($product->price)); ?>đ</p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Giá khuyến mãi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->discount_price ? number_format($product->discount_price) . 'đ' : 'Không có'); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Số lượng tồn kho</label>
                                        </div>
                                        <div class="col-md-8">
                                            <?php if($product->stock == 0): ?>
                                                <span class="badge bg-danger">Hết hàng</span>
                                            <?php else: ?>
                                                <span class="badge bg-success"><?php echo e($product->stock); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Trạng thái</label>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="badge <?php echo e($product->status === 'active' ? 'bg-success' : 'bg-danger'); ?>">
                                                <?php echo e(ucfirst($product->status)); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin thêm -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Thông tin thêm</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Mô tả</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->description); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Người tạo</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->creator->name ?? ''); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Ngày tạo</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->created_at->format('Y-m-d H:i:s')); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label mb-0">Ngày cập nhật</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="form-control-plaintext mb-0"><?php echo e($product->updated_at->format('Y-m-d H:i:s')); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ảnh -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Ảnh sản phẩm</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Ảnh đại diện -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Ảnh đại diện</label>
                                                <div class="text-center">
                                                    <img src="<?php echo e($product->thumbnail_url); ?>" 
                                                         alt="Thumbnail" 
                                                         class="img-thumbnail" 
                                                         style="max-width: 300px;">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Ảnh bổ sung -->
                                        <?php if($product->gallery): ?>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Ảnh bổ sung</label>
                                                    <div class="row">
                                                        <?php $__currentLoopData = json_decode($product->gallery); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-3 mb-2">
                                                                <img src="<?php echo e(asset('storage/' . $image)); ?>" 
                                                                     alt="Gallery" 
                                                                     class="img-thumbnail">
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Các nút hành động -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <div>
                            <a href="<?php echo e(route('admin.products.edit', $product->product_id)); ?>" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Chỉnh sửa
                            </a>
                            <form action="<?php echo e(route('admin.products.destroy', $product->product_id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/products/show.blade.php ENDPATH**/ ?>
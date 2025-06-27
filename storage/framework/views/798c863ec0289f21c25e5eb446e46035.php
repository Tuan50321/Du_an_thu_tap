<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Danh sách sản phẩm</h1>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Ảnh</th>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Người tạo</th>
                            <th width="160px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($product->img): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->img)); ?>" class="img-thumbnail" style="width: 50px;">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($product->product_id); ?></td>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->category->name ?? 'Không rõ'); ?></td>
                            <td><?php echo e($product->brand->name ?? 'Không rõ'); ?></td>
                            <td>
                                <?php if($product->discount_price && $product->discount_price < $product->price): ?>
                                    <span class="text-muted text-decoration-line-through">
                                        <?php echo e(number_format($product->price, 0)); ?>₫
                                    </span><br>
                                    <span class="text-danger fw-bold">
                                        <?php echo e(number_format($product->discount_price, 0)); ?>₫
                                    </span>
                                <?php else: ?>
                                    <?php echo e(number_format($product->price, 0)); ?>₫
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($product->status === 'active' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($product->status === 'active' ? 'Hiển thị' : 'Ẩn'); ?>

                                </span>
                            </td>
                            <td><?php echo e($product->creator->name ?? 'Không rõ'); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.products.show', $product)); ?>" class="btn btn-sm btn-info" title="Xem">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-sm btn-warning" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')" class="btn btn-sm btn-danger" title="Xoá">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">Chưa có sản phẩm nào.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/products/index.blade.php ENDPATH**/ ?>
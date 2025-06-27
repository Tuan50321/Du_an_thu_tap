<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            
                            <div class="mb-3 text-center">
                                <?php if($product->img): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->img)); ?>" class="img-thumbnail" style="max-width: 200px;" alt="Thumbnail">
                                <?php else: ?>
                                    <div class="text-muted">Không có ảnh</div>
                                <?php endif; ?>
                            </div>

                            
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td><?php echo e($product->product_id); ?></td>
                                </tr>
                                <tr>
                                    <th>Tên</th>
                                    <td><?php echo e($product->name); ?></td>
                                </tr>
                                <tr>
                                    <th>Danh mục</th>
                                    <td><?php echo e($product->category->name ?? 'Không rõ'); ?></td>
                                </tr>
                                <tr>
                                    <th>Thương hiệu</th>
                                    <td><?php echo e($product->brand->name ?? 'Không rõ'); ?></td>
                                </tr>
                                <tr>
                                    <th>Giá</th>
                                    <td><?php echo e(number_format($product->price, 0)); ?>₫</td>
                                </tr>
                                <tr>
                                    <th>Giá khuyến mãi</th>
                                    <td>
                                        <?php if($product->discount_price && $product->discount_price < $product->price): ?>
                                            <span class="text-danger fw-bold">
                                                <?php echo e(number_format($product->discount_price, 0)); ?>₫
                                            </span>
                                            <small class="text-muted">
                                                (Giảm <?php echo e(round((1 - $product->discount_price / $product->price) * 100)); ?>%)
                                            </small>
                                        <?php else: ?>
                                            <span class="text-muted">Không có</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <span class="badge bg-<?php echo e($product->status === 'active' ? 'success' : 'secondary'); ?>">
                                            <?php echo e($product->status === 'active' ? 'Hiển thị' : 'Ẩn'); ?>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Người tạo</th>
                                    <td><?php echo e($product->creator->name ?? 'Không rõ'); ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td><?php echo e($product->created_at->format('d/m/Y H:i')); ?></td>
                                </tr>
                                <tr>
                                    <th>Cập nhật</th>
                                    <td><?php echo e($product->updated_at->format('d/m/Y H:i')); ?></td>
                                </tr>
                            </table>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Mô tả sản phẩm</h5>
                                </div>
                                <div class="card-body">
                                    <?php echo $product->description ?? '<p class="text-muted">Chưa có mô tả.</p>'; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <div>
                            <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')">
                                    <i class="fas fa-trash"></i> Xoá
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
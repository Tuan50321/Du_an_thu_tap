<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Mã giảm giá</h1>
            <a href="<?php echo e(route('admin.coupons.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm mã mới
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã</th>
                                <th>Loại mã</th>
                                <th>Giá trị</th>
                                <th>Giảm tối đa</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th width="200px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($coupon->coupon_id); ?></td>
                                    <td><?php echo e($coupon->code); ?></td>
                                    <td><?php echo e(ucfirst($coupon->discount_type)); ?></td>
                                    <td>
                                        <?php echo e($coupon->discount_type === 'percentage' ? $coupon->value . '%' : number_format($coupon->value, 0) . ' ₫'); ?>

                                    </td>
                                    <td><?php echo e(number_format($coupon->max_discount_amount ?? 0, 0)); ?> ₫</td>
                                    <td><?php echo e($coupon->start_date); ?></td>
                                    <td><?php echo e($coupon->end_date); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($coupon->status ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo e($coupon->status ? 'Đang hoạt động' : 'Ngừng hoạt động'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.coupons.show', $coupon)); ?>"
                                            class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.coupons.edit', $coupon)); ?>" class="btn btn-sm btn-warning"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.coupons.destroy', $coupon)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this coupon?')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($coupons->isEmpty()): ?>
                                <tr>
                                    <td colspan="9" class="text-center">Không tìm thấy mã giảm giá nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/coupons/index.blade.php ENDPATH**/ ?>
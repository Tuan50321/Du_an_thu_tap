<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản lý Đánh giá</h1>
            
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form method="GET" action="<?php echo e(route('admin.reviews.index')); ?>" class="mb-4 d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control w-auto"
                placeholder="Tìm theo nội dung...">
            <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Sản phẩm</th>
                                <th>Điểm</th>
                                <th>Nội dung</th>
                                <th>Duyệt</th>
                                <th>Ngày tạo</th>
                                <th width="150px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->review_id); ?></td>
                                    <td><?php echo e($item->user?->name ?? 'Không rõ'); ?></td>
                                    <td><?php echo e($item->product?->name ?? 'Không rõ'); ?></td>
                                    <td><?php echo e($item->rating); ?>/5</td>
                                    <td><?php echo e($item->content); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($item->is_approved ? 'success' : 'secondary'); ?>">
                                            <?php echo e($item->is_approved ? 'Hiển thị' : 'Đã ẩn'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($item->created_at?->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('admin.reviews.toggle', $item->review_id)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit"
                                                class="btn btn-sm btn-<?php echo e($item->is_approved ? 'warning' : 'secondary'); ?>"
                                                title="<?php echo e($item->is_approved ? 'Ẩn đánh giá' : 'Hiện đánh giá'); ?>">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </form>

                                        <a href="<?php echo e(route('admin.reviews.show', $item)); ?>" class="btn btn-sm btn-info"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Không có đánh giá nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <?php echo e($reviews->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>
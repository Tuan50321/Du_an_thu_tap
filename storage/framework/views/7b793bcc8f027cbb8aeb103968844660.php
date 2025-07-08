<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h1 class="mb-4">Chi tiết đánh giá #<?php echo e($review->review_id); ?></h1>

        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Người dùng</dt>
                    <dd class="col-sm-9"><?php echo e($review->user?->name ?? 'Không rõ'); ?></dd>

                    <dt class="col-sm-3">Sản phẩm</dt>
                    <dd class="col-sm-9"><?php echo e($review->product?->name ?? 'Không rõ'); ?></dd>

                    <dt class="col-sm-3">Điểm đánh giá</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-info"><?php echo e($review->rating); ?>/5</span>
                    </dd>

                    <dt class="col-sm-3">Nội dung</dt>
                    <dd class="col-sm-9"><?php echo e($review->content); ?></dd>

                    <dt class="col-sm-3">Trạng thái duyệt</dt>
                    <dd class="col-sm-9">
                        <?php if($review->is_approved): ?>
                            <span class="badge bg-success">Đã duyệt</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Chưa duyệt</span>
                        <?php endif; ?>
                    </dd>

                    <dt class="col-sm-3">Ngày tạo</dt>
                    <dd class="col-sm-9"><?php echo e($review->created_at->format('d/m/Y H:i')); ?></dd>
                </dl>

                <a href="<?php echo e(route('admin.reviews.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
                <a href="<?php echo e(route('admin.reviews.edit', $review)); ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Chỉnh sửa
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/reviews/show.blade.php ENDPATH**/ ?>
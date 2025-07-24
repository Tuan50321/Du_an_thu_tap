<?php $__env->startSection('content'); ?>
<h1>Chi tiết bài viết</h1>

<div class="mb-3 border-bottom pb-3 bg-light-subtle rounded p-3 mb-4">
    <strong>Tiêu đề:</strong> <?php echo e($news->title); ?>

</div>

<div class="mb-3 border-bottom pb-3 bg-light-subtle rounded p-3 mb-4">
    <strong>Danh mục:</strong>
    <span class="badge bg-info-subtle text-dark">
        <?php echo e($news->category?->name ?? 'Không có'); ?>

    </span>
</div>

<div class="mb-3">
    <strong>Ảnh đại diện:</strong><br>
    <?php if($news->image): ?>
        <img src="<?php echo e(asset($news->image)); ?>" alt="Ảnh bài viết" width="300">
    <?php else: ?>
        <p>Chưa có ảnh</p>
    <?php endif; ?>
</div>

<div class="mb-3 border-bottom pb-3 bg-light-subtle rounded p-3 mb-4">
    <strong>Nội dung:</strong>
    <div class="border p-2">
        <?php echo $news->content; ?>

    </div>
</div>


<div class="mb-3 border-bottom pb-3 bg-light-subtle rounded p-3 mb-4">
    <strong>Trạng thái:</strong>
    <span class="badge bg-<?php echo e($news->status === 'published' ? 'success' : 'secondary'); ?>">
        <?php echo e($news->status === 'published' ? 'Đã đăng' : 'Nháp'); ?>

    </span>
</div>

<div class="mb-3 border-bottom pb-3 bg-light-subtle rounded p-3 mb-4">
    <strong>Ngày đăng:</strong>
    <?php echo e($news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Chưa đăng'); ?>

</div>

<a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-secondary">Quay lại</a>


<div class="mt-5 mb-5 border-top pt-3 bg-light-subtle rounded p-3">
    <h3>Bình luận</h3>
    <?php if($news->comments->isEmpty()): ?>
        <p>Chưa có bình luận nào.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php $__currentLoopData = $news->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <strong><?php echo e($comment->user->name ?? 'Người dùng không xác định'); ?>:</strong>
                    <p><?php echo e($comment->content); ?></p>
                    <small class="text-muted">
                        <?php echo e($comment->created_at->format('d/m/Y H:i')); ?>

                        <?php if($comment->updated_at): ?>
                            (Cập nhật: <?php echo e($comment->updated_at->format('d/m/Y H:i')); ?>)
                        <?php endif; ?>
                    </small>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>                       
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/news/show.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Chi tiết liên hệ</h1>

    <div class="card">
        <div class="card-body">
            <h5><strong>Họ tên:</strong> <?php echo e($contact->name); ?></h5>

            <p><strong>Email:</strong> <?php echo e($contact->email ?? 'Không có'); ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo e($contact->phone ?? 'Không có'); ?></p>
            <p><strong>Nội dung:</strong></p>
            <p class="border p-3 rounded bg-light"><?php echo e($contact->message); ?></p>

            <p><strong>Gửi lúc:</strong> <?php echo e($contact->created_at->format('d/m/Y H:i')); ?></p>
        </div>
    </div>

    <a href="<?php echo e(route('admin.contacts.index')); ?>" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/contact/show.blade.php ENDPATH**/ ?>
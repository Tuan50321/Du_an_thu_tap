

<?php $__env->startSection('title', 'Chi tiết Role'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Chi tiết Role</h1>
    <div class="mb-3">
        <strong>ID:</strong> <?php echo e($role->role_id); ?>

    </div>
    <div class="mb-3">
        <strong>Tên:</strong> <?php echo e($role->name); ?>

    </div>
    <div class="mb-3">
        <strong>Slug:</strong> <?php echo e($role->slug); ?>

    </div>
    <div class="mb-3">
        <strong>Role cha:</strong> <?php echo e($role->parent ? $role->parent->name : 'Không'); ?>

    </div>
    <div class="mb-3">
        <strong>Trạng thái:</strong> <?php echo e($role->status ? 'Kích hoạt' : 'Ẩn'); ?>

    </div>
    <div class="mb-3">
        <strong>Ảnh:</strong>
        <?php if($role->image): ?>
            <img src="<?php echo e(asset('storage/' . $role->image)); ?>" alt="Ảnh" width="120">
        <?php else: ?>
            Không có ảnh
        <?php endif; ?>
    </div>
    <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-secondary">Quay lại</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/roles/show.blade.php ENDPATH**/ ?>
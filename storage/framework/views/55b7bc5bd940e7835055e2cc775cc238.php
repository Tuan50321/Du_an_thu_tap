

<?php $__env->startSection('content'); ?>
    <h1>Chỉnh sửa quyền: <?php echo e($permission->name); ?></h1>

    <form action="<?php echo e(route('admin.permissions.update', $permission)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="name" class="form-label">Tên quyền</label>
            <input type="text" class="form-control" name="name" value="<?php echo e(old('name', $permission->name)); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" name="description"><?php echo e(old('description', $permission->description)); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="<?php echo e(route('admin.permissions.list')); ?>" class="btn btn-secondary">Hủy</a>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/permissions/edit.blade.php ENDPATH**/ ?>
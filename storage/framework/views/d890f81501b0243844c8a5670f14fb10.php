<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Phân quyền cho vai trò</h1>
        <a href="<?php echo e(route('admin.permissions.create')); ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm quyền mới
        </a>
    </div>

    <?php if($roles->contains('name', 'user')): ?>
        <div class="alert alert-info">
            Vai trò <strong>user (khách hàng)</strong> bị hạn chế, không thể thực hiện các quyền quản trị.
        </div>
    <?php elseif(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.permissions.updateRoles')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="card">
            <div class="card-body">
                <a href="<?php echo e(route('admin.permissions.list')); ?>" class="btn btn-success mb-3">
                    <i class="fas fa-list"></i> Danh sách vai trò
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start">Quyền \ Vai trò</th>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($role->name); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-start">
                                        <strong><?php echo e($permission->name); ?></strong><br>
                                        <small class="text-muted"><?php echo e($permission->description); ?></small>
                                    </td>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <input type="checkbox"
                                                name="permissions[<?php echo e($role->id); ?>][]"
                                                value="<?php echo e($permission->id); ?>"
                                                <?php echo e($role->permissions->pluck('id')->contains($permission->id) ? 'checked' : ''); ?>

                                            >
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật quyền
                    </button>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>
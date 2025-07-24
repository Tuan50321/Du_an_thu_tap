<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Phân vai trò cho người dùng</h1>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <a href="<?php echo e(route('admin.roles.list')); ?>" class="btn btn-success">
                <i class="fas fa-plus"></i> Danh sách vai trò
            </a>

            <form action="<?php echo e(route('admin.roles.updateUsers')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Người dùng \ Vai trò</th>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($role->name); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-start">
                                    <strong><?php echo e($user->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($user->email); ?></small>
                                </td>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        <input type="checkbox" name="roles[<?php echo e($user->id); ?>][]"
                                            value="<?php echo e($role->id); ?>"
                                            <?php echo e($user->roles->pluck('id')->contains($role->id) ? 'checked' : ''); ?>

                                            <?php if($user->id == auth()->id()): ?> disabled <?php endif; ?>
                                        >
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật vai trò
                    </button>
                </div>
            </form>

            <div class="mt-3">
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>
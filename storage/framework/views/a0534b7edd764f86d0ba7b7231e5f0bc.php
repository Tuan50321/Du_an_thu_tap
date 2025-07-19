

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý quyền</h1>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.permissions.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-shield-alt"></i> Phân quyền
            </a>
            <a href="<?php echo e(route('admin.permissions.trashed')); ?>" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Thùng rác
            </a>
            <a href="<?php echo e(route('admin.permissions.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm quyền
            </a>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('admin.permissions.list')); ?>" class="mb-4 d-flex gap-2 align-items-center">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control w-25"
               placeholder="Tìm quyền...">
        <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
        <?php if(request('search')): ?>
            <a href="<?php echo e(route('admin.permissions.list')); ?>" class="btn btn-secondary">Xoá lọc</a>
        <?php endif; ?>
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên quyền</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($permission->id); ?></td>
                                <td><?php echo e($permission->name); ?></td>
                                <td><?php echo e($permission->description ?? 'Không có mô tả'); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        
                                        <a href="<?php echo e(route('admin.permissions.edit', $permission)); ?>" class="btn btn-outline-primary btn-sm" title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.permissions.destroy', $permission)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc muốn xoá vai trò này?')" title="Xoá">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Không tìm thấy quyền nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3"><?php echo e($permissions->links('pagination::bootstrap-5')); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/permissions/list.blade.php ENDPATH**/ ?>
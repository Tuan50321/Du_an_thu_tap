

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý vai trò</h1>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Trở về trang vai trò
            </a>
            <a href="<?php echo e(route('admin.roles.trashed')); ?>" class="btn btn-danger">
                <i class="fas fa-trash"></i> Thùng rác
            </a>
            <a href="<?php echo e(route('admin.roles.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm vai trò
            </a>
        </div>
    </div>

    <form method="GET" action="<?php echo e(route('admin.roles.index')); ?>" class="mb-4 d-flex gap-2 align-items-center">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control w-25"
            placeholder="Tìm vai trò...">
        <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>

        <?php if(request('search')): ?>
            <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Quay lại danh sách đầy đủ
            </a>
        <?php endif; ?>
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover table-centered">
                    <thead class="bg-light-subtle">
                        <tr>
                            <th>ID</th>
                            <th>Tên vai trò</th>
                            <th>Mô tả</th>
                            <th>Số quyền</th>
                            <th>Trạng thái</th>
                            <th width="200px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($role->id); ?></td>
                                <td>
                                    <p class="text-dark fw-medium fs-15 mb-0"><?php echo e($role->name); ?></p>
                                </td>
                                <td><?php echo e($role->description ?? 'Không có mô tả'); ?></td>
                                <td>
                                    <span class="badge bg-info"><?php echo e($role->permissions->count()); ?> quyền</span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($role->is_active ? 'success' : 'secondary'); ?>">
                                        <?php echo e($role->is_active ? 'Hoạt động' : 'Không hoạt động'); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?php echo e(route('admin.roles.show', $role)); ?>" class="btn btn-outline-secondary btn-sm" title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.roles.edit', $role)); ?>" class="btn btn-outline-primary btn-sm" title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.roles.destroy', $role)); ?>" method="POST" class="d-inline">
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
                                <td colspan="6" class="text-center text-secondary">Không tìm thấy vai trò nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="mt-3">
                    <?php echo e($roles->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/roles/list.blade.php ENDPATH**/ ?>
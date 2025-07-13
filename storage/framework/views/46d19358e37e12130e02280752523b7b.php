<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Banners</h1>
            <a href="<?php echo e(route('admin.banners.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Banner
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Link URL</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th width="200px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($banner->banner_id); ?></td>
                                    <td>
                                        <?php if($banner->image_url): ?>
                                            <img src="<?php echo e(asset('storage/' . $banner->image_url)); ?>" alt="Banner"
                                                style="max-width: 200px;">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($banner->link_url): ?>
                                            <a href="<?php echo e($banner->link_url); ?>" target="_blank"><?php echo e($banner->link_url); ?></a>
                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($banner->position); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($banner->is_active ? 'success' : 'secondary'); ?>">
                                            <?php echo e($banner->is_active ? 'Active' : 'Inactive'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.banners.show', $banner)); ?>" class="btn btn-sm btn-info"
                                            title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.banners.edit', $banner)); ?>" class="btn btn-sm btn-warning"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.banners.destroy', $banner)); ?>" method="POST"
                                            class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this banner?')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No banners found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/banners/index.blade.php ENDPATH**/ ?>
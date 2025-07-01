<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Banner Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200px">ID</th>
                                <td><?php echo e($banner->banner_id); ?></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>
                                    <img src="<?php echo e($banner->image_url); ?>" alt="Banner Image"
                                        style="max-width: 100%; height: auto;">
                                </td>
                            </tr>
                            <tr>
                                <th>Link URL</th>
                                <td><?php echo e($banner->link_url ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <th>Position</th>
                                <td><?php echo e($banner->position); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-<?php echo e($banner->is_active ? 'success' : 'secondary'); ?>">
                                        <?php echo e($banner->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </td>
                            </tr>
                        </table>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="<?php echo e(route('admin.banners.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <div>
                                <a href="<?php echo e(route('admin.banners.edit', $banner)); ?>" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/banners/show.blade.php ENDPATH**/ ?>
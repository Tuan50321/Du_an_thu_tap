

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Brand Details</h1>
        <div>
            <a href="<?php echo e(route('admin.brands.edit', $brand)); ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Brand
            </a>
            <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Brand ID:</th>
                            <td><?php echo e($brand->brand_id); ?></td>
                        </tr>
                        <tr>
                            <th>Brand Name:</th>
                            <td><?php echo e($brand->name); ?></td>
                        </tr>
                        <tr>
                            <th>Slug:</th>
                            <td><?php echo e($brand->slug); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('admin.brands.edit', $brand)); ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Brand
                        </a>
                        <form action="<?php echo e(route('admin.brands.destroy', $brand)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Are you sure you want to delete this brand?')">
                                <i class="fas fa-trash"></i> Delete Brand
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($brand->description): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Description</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0"><?php echo e($brand->description); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/brands/show.blade.php ENDPATH**/ ?>
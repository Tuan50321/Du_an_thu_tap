

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Category Details</h1>
        <div>
            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Category
            </a>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 150px;">ID:</th>
                            <td><?php echo e($category->category_id); ?></td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo e($category->name); ?></td>
                        </tr>
                        <tr>
                            <th>Slug:</th>
                            <td><?php echo e($category->slug); ?></td>
                        </tr>
                        <tr>
                            <th>Parent Category:</th>
                            <td>
                                <?php if($category->parent): ?>
                                    <a href="<?php echo e(route('admin.categories.show', $category->parent)); ?>">
                                        <?php echo e($category->parent->name); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">None</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Subcategories</h5>
                    <a href="<?php echo e(route('admin.categories.create')); ?>?parent_id=<?php echo e($category->category_id); ?>" 
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Subcategory
                    </a>
                </div>
                <div class="card-body">
                    <?php if($category->children->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(route('admin.categories.show', $child)); ?>">
                                                    <?php echo e($child->name); ?>

                                                </a>
                                            </td>
                                            <td><?php echo e($child->slug); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('admin.categories.edit', $child)); ?>" 
                                                    class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?php echo e(route('admin.categories.destroy', $child)); ?>" 
                                                    method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this subcategory?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">No subcategories found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/categories/show.blade.php ENDPATH**/ ?>
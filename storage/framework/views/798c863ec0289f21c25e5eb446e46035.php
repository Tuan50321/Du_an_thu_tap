<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e($product->thumbnail_url); ?>" alt="Thumbnail" class="img-thumbnail" style="max-width: 50px;">
                                </td>
                                <td><?php echo e($product->product_id); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->category ? $product->category->name : 'N/A'); ?></td>
                                <td><?php echo e($product->brand ? $product->brand->name : 'N/A'); ?></td>
                                <td>
                                    <?php if($product->is_discounted): ?>
                                        <span class="text-decoration-line-through text-muted">
                                            $<?php echo e(number_format($product->price, 2)); ?>

                                        </span>
                                        <span class="text-danger">
                                            $<?php echo e(number_format($product->discount_price, 2)); ?>

                                        </span>
                                    <?php else: ?>
                                        $<?php echo e(number_format($product->price, 2)); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($product->status === 'active' ? 'success' : 'danger'); ?>">
                                        <?php echo e(ucfirst($product->status)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($product->creator ? $product->creator->name : 'N/A'); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.products.show', $product)); ?>" class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/products/index.blade.php ENDPATH**/ ?>
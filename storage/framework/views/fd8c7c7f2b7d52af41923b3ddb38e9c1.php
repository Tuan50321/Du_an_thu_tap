

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Thêm phần hiển thị ảnh thumbnail -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5>Thumbnail</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="<?php echo e($product->thumbnail_url); ?>" alt="Thumbnail" class="img-fluid" style="max-width: 200px;">
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200px">ID</th>
                                    <td><?php echo e($product->product_id); ?></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo e($product->name); ?></td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><?php echo e($product->category ? $product->category->name : 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td><?php echo e($product->brand ? $product->brand->name : 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>$<?php echo e(number_format($product->price, 2)); ?></td>
                                </tr>
                                <tr>
                                    <th>Discount Price</th>
                                    <td>
                                        <?php if($product->discount_price): ?>
                                            $<?php echo e(number_format($product->discount_price, 2)); ?>

                                            <small class="text-muted">
                                                (<?php echo e(round((1 - $product->discount_price / $product->price) * 100)); ?>% off)
                                            </small>
                                        <?php else: ?>
                                            No discount
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-<?php echo e($product->status === 'active' ? 'success' : 'danger'); ?>">
                                            <?php echo e(ucfirst($product->status)); ?>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created By</th>
                                    <td><?php echo e($product->creator ? $product->creator->name : 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td><?php echo e($product->created_at->format('Y-m-d H:i:s')); ?></td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td><?php echo e($product->updated_at->format('Y-m-d H:i:s')); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Description</h5>
                                </div>
                                <div class="card-body">
                                    <?php echo e($product->description ?? 'No description available.'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <div>
                            <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/products/show.blade.php ENDPATH**/ ?>
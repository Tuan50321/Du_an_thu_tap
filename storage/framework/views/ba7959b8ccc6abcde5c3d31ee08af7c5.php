<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
<<<<<<< HEAD
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
=======
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4>Chỉnh sửa sản phẩm</h4>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
<<<<<<< HEAD
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
=======

                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control <?php $__errorArgs = ['name'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="name" name="name" value="<?php echo e(old('name', $product->name)); ?>" required>
=======
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('name', $product->name)); ?>" required>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
<<<<<<< HEAD
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select <?php $__errorArgs = ['category_id'];
=======
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select name="category_id" id="category_id"
                                        class="form-select <?php $__errorArgs = ['category_id'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->category_id); ?>" 
=======
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->category_id); ?>"
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                                <?php echo e(old('category_id', $product->category_id) == $category->category_id ? 'selected' : ''); ?>>
                                                <?php echo e($category->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
<<<<<<< HEAD
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select class="form-select <?php $__errorArgs = ['brand_id'];
=======
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select name="brand_id" id="brand_id"
                                        class="form-select <?php $__errorArgs = ['brand_id'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="brand_id" name="brand_id" required>
                                        <option value="">Select Brand</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->brand_id); ?>" 
=======
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">-- Chọn thương hiệu --</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->brand_id); ?>"
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                                <?php echo e(old('brand_id', $product->brand_id) == $brand->brand_id ? 'selected' : ''); ?>>
                                                <?php echo e($brand->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

<<<<<<< HEAD
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="0.01" class="form-control <?php $__errorArgs = ['price'];
=======
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" step="0.01" id="price" name="price"
                                        class="form-control <?php $__errorArgs = ['price'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="price" name="price" value="<?php echo e(old('price', $product->price)); ?>" required>
=======
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('price', $product->price)); ?>" required>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
<<<<<<< HEAD
                                    <label for="discount_price" class="form-label">Discount Price</label>
                                    <input type="number" step="0.01" class="form-control <?php $__errorArgs = ['discount_price'];
=======
                                    <label for="discount_price" class="form-label">Giá khuyến mãi</label>
                                    <input type="number" step="0.01" id="discount_price" name="discount_price"
                                        class="form-control <?php $__errorArgs = ['discount_price'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="discount_price" name="discount_price" value="<?php echo e(old('discount_price', $product->discount_price)); ?>">
=======
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('discount_price', $product->discount_price)); ?>">
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                    <?php $__errorArgs = ['discount_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
<<<<<<< HEAD
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select <?php $__errorArgs = ['status'];
=======
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select name="status" id="status"
                                        class="form-select <?php $__errorArgs = ['status'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="status" name="status" required>
                                        <option value="active" <?php echo e(old('status', $product->status) == 'active' ? 'selected' : ''); ?>>Active</option>
                                        <option value="inactive" <?php echo e(old('status', $product->status) == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
=======
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="active" <?php echo e(old('status', $product->status) == 'active' ? 'selected' : ''); ?>>Hiển thị</option>
                                        <option value="inactive" <?php echo e(old('status', $product->status) == 'inactive' ? 'selected' : ''); ?>>Ẩn</option>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                    </select>
                                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

<<<<<<< HEAD
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control <?php $__errorArgs = ['description'];
=======
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="form-control <?php $__errorArgs = ['description'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" 
                                        id="description" name="description" rows="4"><?php echo e(old('description', $product->description)); ?></textarea>
=======
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description', $product->description)); ?></textarea>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

<<<<<<< HEAD
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo e($product->thumbnail_url); ?>" alt="Thumbnail" class="img-thumbnail mr-3" style="max-width: 100px;">
                                        <input type="file" class="form-control-file <?php $__errorArgs = ['thumbnail'];
=======
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ảnh hiện tại</label><br>
                                    <?php if($product->img): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->img)); ?>" alt="thumbnail" class="img-thumbnail" style="max-width: 120px;">
                                    <?php else: ?>
                                        <p class="text-muted">Chưa có ảnh</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thay ảnh đại diện</label>
                                    <input type="file" name="thumbnail" id="thumbnail"
                                        class="form-control <?php $__errorArgs = ['thumbnail'];
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
<<<<<<< HEAD
unset($__errorArgs, $__bag); ?>" id="thumbnail" name="thumbnail">
                                    </div>
=======
unset($__errorArgs, $__bag); ?>">
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                                    <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
<<<<<<< HEAD
=======

                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="gallery" class="form-label">Ảnh chi tiết (gallery)</label>
                                    <input type="file" name="gallery[]" id="gallery"
                                        class="form-control <?php $__errorArgs = ['gallery.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" multiple>
                                    <?php $__errorArgs = ['gallery.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <?php if($product->gallery && is_array(json_decode($product->gallery, true))): ?>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Ảnh chi tiết hiện tại:</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <?php $__currentLoopData = json_decode($product->gallery, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="text-center">
                                                <img src="<?php echo e(asset('storage/' . $image)); ?>" class="img-thumbnail" style="width: 100px;">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">
<<<<<<< HEAD
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Product
=======
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Cập nhật sản phẩm
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<<<<<<< HEAD
=======

>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>
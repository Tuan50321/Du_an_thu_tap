<?php $__env->startSection('title', 'Danh sách sản phẩm'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .pagination-wrapper nav {
            padding: 8px 16px;
            background-color: #fff;
            border-radius: 10px;
        }
        .product-thumbnail {
            max-width: 30px !important;
            max-height: 30px !important;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-3 px-md-5 mt-4">
        <!-- Thông báo -->
        <?php if(session('status')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('status')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <!-- Nút thêm -->
                <div class="mb-3 d-flex justify-content-end flex-wrap gap-2">
                    <a href="<?php echo e(route('admin.products.create')); ?>"
                        class="btn btn-outline-success d-flex align-items-center gap-1" title="Thêm sản phẩm mới">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                        <span class="d-none d-sm-inline">Thêm</span>
                    </a>
                </div>

                <!-- Form tìm kiếm -->
                <form action="" method="get" class="row row-cols-1 row-cols-sm-auto g-2 align-items-center mb-3">
                    <div class="col">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm"
                            value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm" title="Tìm kiếm">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </form>

                <!-- Bảng sản phẩm -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th>Giá bán</th>
                                <th>Số lượng tồn</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo e($product->thumbnail_url); ?>" alt="<?php echo e($product->name); ?>" class="product-thumbnail" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td><?php echo e($product->product_id); ?></td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td><?php echo e($product->category->name ?? ''); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.brands.show', ['brand_id' => $product->brand_id])); ?>" 
                                           class="text-decoration-none" 
                                           title="Xem chi tiết thương hiệu">
                                            <?php echo e($product->brand->name ?? 'Không có'); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e(number_format($product->price)); ?>đ</td>
                                    <td>
                                        <?php if($product->stock == 0): ?>
                                            <span class="badge bg-danger">Hết hàng</span>
                                        <?php elseif($product->stock < 5): ?>
                                            <span class="badge bg-warning">Sắp hết</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Còn hàng</span>
                                        <?php endif; ?>
                                        <span class="ms-2"><?php echo e($product->stock); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo e($product->status ? 'bg-success' : 'bg-danger'); ?>">
                                            <?php echo e($product->status ? 'Hoạt động' : 'Không hoạt động'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($product->creator->name ?? ''); ?></td>
                                    <td><?php echo e($product->created_at->format('d/m/Y H:i')); ?></td>
                                    <td><?php echo e($product->updated_at->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Xem -->
                                            <a href="<?php echo e(route('admin.products.show', $product->product_id)); ?>"
                                                class="btn btn-outline-info btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Xem chi tiết">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            
                                            <!-- Sửa -->
                                            <a href="<?php echo e(route('admin.products.edit', $product->product_id)); ?>"
                                                class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Sửa sản phẩm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            
                                            <!-- Xóa -->
                                            <form action="<?php echo e(route('admin.products.destroy', $product->product_id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                    title="Xóa sản phẩm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="12" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-box-seam fs-1 mb-2"></i>
                                            <p class="mb-0">Không có sản phẩm nào</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="pagination-wrapper mt-3 text-center">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/products/index.blade.php ENDPATH**/ ?>
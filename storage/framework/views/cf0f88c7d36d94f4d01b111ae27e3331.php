<?php $__env->startSection('title', 'Danh sách thương hiệu'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .pagination-wrapper nav {
            padding: 8px 16px;
            background-color: #fff;
            border-radius: 10px;
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
                    <a href="<?php echo e(route('admin.brands.create')); ?>"
                        class="btn btn-outline-success d-flex align-items-center gap-1" title="Thêm thương hiệu mới">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                        <span class="d-none d-sm-inline">Thêm</span>
                    </a>
                </div>

                <!-- Form tìm kiếm -->
                <form action="" method="get" class="row row-cols-1 row-cols-sm-auto g-2 align-items-center mb-3">
                    <div class="col">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm thương hiệu"
                            value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm" title="Tìm kiếm">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </form>

                <!-- Bảng thương hiệu -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên thương hiệu</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($brand->brand_id); ?></td>
                                    <td><?php echo e($brand->name); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($brand->status === 'active' ? 'bg-success' : 'bg-danger'); ?>">
                                            <?php echo e($brand->status === 'active' ? 'Hoạt động' : 'Không hoạt động'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Xem -->
                                            <a href="<?php echo e(route('admin.brands.show', ['brand_id' => $brand->brand_id])); ?>"
                                                class="btn btn-outline-info btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Xem chi tiết">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            
                                            <!-- Sửa -->
                                            <a href="<?php echo e(route('admin.brands.edit', ['brand_id' => $brand->brand_id])); ?>"
                                                class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Sửa thương hiệu">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            
                                            <!-- Xóa -->
                                            <form action="<?php echo e(route('admin.brands.destroy', ['brand_id' => $brand->brand_id])); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                    title="Xóa thương hiệu"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-box-seam fs-1 mb-2"></i>
                                            <p class="mb-0">Không có thương hiệu nào</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="pagination-wrapper mt-3 text-center">
                    <?php echo e($brands->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/brands/index.blade.php ENDPATH**/ ?>
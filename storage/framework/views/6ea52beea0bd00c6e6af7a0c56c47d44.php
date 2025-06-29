<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
<<<<<<< HEAD
            <h1>Bảng điều khiển</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chào mừng bạn đến với Trang Quản Trị</h5>
                    <p class="card-text">Bạn có thể quản lý nội dung từ đây.</p>
                </div>
            </div>
            <?php $__env->startPush('styles'); ?>
            <style>
                .stat-card {
                    border-radius: 18px;
                    box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08);
                    transition: transform 0.2s, box-shadow 0.2s;
                    position: relative;
                    overflow: hidden;
                    min-height: 160px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: flex-start;
                    height: 100%;
                }
                .stat-card:hover {
                    transform: translateY(-4px) scale(1.03);
                    box-shadow: 0 8px 32px 0 rgba(0,0,0,0.15);
                    z-index: 2;
                }
                .stat-icon {
                    font-size: 2.8rem;
                    opacity: 0.18;
                    position: absolute;
                    right: 18px;
                    bottom: 10px;
                    pointer-events: none;
                }
                .stat-title {
                    font-size: 1.1rem;
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                    letter-spacing: 0.5px;
                }
                .stat-value {
                    font-size: 2.2rem;
                    font-weight: bold;
                    margin-bottom: 0;
                }
                .stat-row {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1.5rem 0.5rem;
                }
                .stat-col {
                    display: flex;
                    flex-direction: column;
                    height: 100%;
                }
                @media (max-width: 767px) {
                    .stat-row { gap: 1rem 0; }
                }
            </style>
            <?php $__env->stopPush(); ?>
            <div class="row mt-4 stat-row">
                <div class="col-md-3 col-6 stat-col">
                    <div class="card stat-card text-white bg-primary h-100">
                        <div class="card-body">
                            <a href="<?php echo e(route('admin.orders.index')); ?>" class="stat-title text-white text-decoration-underline" style="cursor:pointer">Tổng đơn hàng</a>
                            <div class="stat-value"><?php echo e(number_format($orderCount, 0, ',', '.')); ?></div>
                            <i class="fas fa-shopping-cart stat-icon" title="Tổng số đơn hàng"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 stat-col">
                    <div class="card stat-card text-white bg-success h-100">
                        <div class="card-body">
                            <a href="<?php echo e(route('admin.orders.index')); ?>" class="stat-title text-white text-decoration-underline" style="cursor:pointer">Tổng doanh thu</a>
                            <div class="stat-value"><?php echo e(number_format($totalRevenue, 0, ',', '.')); ?> đ</div>
                            <i class="fas fa-coins stat-icon" title="Tổng doanh thu"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-6 stat-col">
                    <div class="card stat-card text-white bg-info h-100">
                        <div class="card-body">
                            <a href="<?php echo e(route('admin.products.index')); ?>" class="stat-title text-white text-decoration-underline" style="cursor:pointer">Tổng sản phẩm</a>
                            <div class="stat-value"><?php echo e(number_format($productCount, 0, ',', '.')); ?></div>
                            <i class="fas fa-boxes stat-icon" title="Tổng số sản phẩm"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-12 stat-col">
                    <div class="card stat-card text-white bg-dark h-100">
                        <div class="card-body">
                            <a href="<?php echo e(route('admin.users.index')); ?>" class="stat-title text-white text-decoration-underline" style="cursor:pointer">Tổng người dùng</a>
                            <div class="stat-value"><?php echo e(number_format($totalUsers, 0, ',', '.')); ?></div>
                            <i class="fas fa-user-shield stat-icon" title="Tổng số người dùng"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-12 stat-col">
                    <div class="card stat-card text-white bg-secondary h-100">
                        <div class="card-body">
                            <a href="<?php echo e(route('admin.news.index')); ?>" class="stat-title text-white text-decoration-underline" style="cursor:pointer">Tổng bài viết</a>
                            <div class="stat-value"><?php echo e(number_format($newsCount, 0, ',', '.')); ?></div>
                            <i class="fas fa-newspaper stat-icon" title="Tổng số bài viết"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sản phẩm bán chạy nhất -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="fas fa-fire text-danger me-2"></i>Sản phẩm bán chạy nhất</h4>
                    <div class="row g-3">
                        <?php $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-6">
                            <div class="card h-100 shadow-sm">
                                <img src="<?php echo e($product->thumbnail_url ?? asset('images/default-thumbnail.jpg')); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>">
                                <div class="card-body">
                                    <h6 class="card-title mb-1" style="font-size:1rem"><?php echo e($product->name); ?></h6>
                                    <div class="mb-1 text-muted" style="font-size:0.95rem">Giá: <span class="fw-bold text-danger"><?php echo e(number_format($product->display_price, 0, ',', '.')); ?> đ</span></div>
                                    <div class="small">Đã bán: <span class="fw-bold"><?php echo e($product->total_sold ?? 0); ?></span></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <!-- Sản phẩm mới nhất -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="fas fa-star text-warning me-2"></i>Sản phẩm mới nhất</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0 bg-white">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Ngày thêm</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:70px">
                                        <img src="<?php echo e($product->thumbnail_url ?? asset('images/default-thumbnail.jpg')); ?>" alt="<?php echo e($product->name); ?>" class="img-thumbnail" style="max-width:60px;max-height:60px">
                                    </td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td class="text-danger fw-bold"><?php echo e(number_format($product->display_price, 0, ',', '.')); ?> đ</td>
                                    <td><?php echo e($product->created_at ? $product->created_at->format('d/m/Y') : 'N/A'); ?></td>
                                    <td>
                                        <?php if($product->status === 'active'): ?>
                                            <span class="badge bg-success">Đang bán</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Ngừng bán</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
=======
            <h1>Dashboard</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Welcome to Admin Dashboard</h5>
                    <p class="card-text">This is your admin dashboard. You can manage your content from here.</p>
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?> 
=======
<?php $__env->stopSection(); ?> 
>>>>>>> f2b6f01 (Merge branch 'main' of https://github.com/Tuan50321/Du_an_thu_tap)
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
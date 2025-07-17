<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Quản lý đơn hàng</h3>
                    </div>
                    <div class="card-body">
                        <?php if($orders->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Khách hàng</th>
                                            <th>Trạng thái</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Tổng tiền</th>
                                            <th>Ngày đặt</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($order->order_id); ?></td>
                                                <td><?php echo e($order->user?->name ?? 'Không xác định'); ?></td>
                                                <?php
                                                    $statusLabels = [
                                                        'pending' => ['label' => 'Chờ xác nhận', 'color' => 'warning'],
                                                        'confirmed' => ['label' => 'Đã xác nhận', 'color' => 'primary'],
                                                        'processing' => ['label' => 'Đang xử lý', 'color' => 'info'],
                                                        'shipping' => ['label' => 'Đang giao', 'color' => 'secondary'],
                                                        'delivered' => ['label' => 'Đã giao', 'color' => 'success'],
                                                        'completed' => ['label' => 'Hoàn tất', 'color' => 'success'],
                                                        'cancelled' => ['label' => 'Đã hủy', 'color' => 'danger'],
                                                        'refunded' => ['label' => 'Đã hoàn tiền', 'color' => 'dark'],
                                                    ];
                                                ?>

                                                <td>
                                                    <span class="badge bg-<?php echo e($order->status_badge_class); ?>">
                                                        <?php echo e($order->status_text); ?>

                                                    </span>
                                                </td>

                                                <td><?php echo e(strtoupper($order->payment_method)); ?></td>
                                                <td><?php echo e(number_format($order->total_amount, 0, ',', '.')); ?> ₫</td>
                                                <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('admin.orders.show', $order->order_id)); ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> Chi tiết
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php else: ?>
                            <div class="alert alert-info text-center">
                                Không có đơn hàng nào được tìm thấy.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>
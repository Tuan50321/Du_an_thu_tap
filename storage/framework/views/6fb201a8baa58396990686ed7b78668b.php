<?php $__env->startSection('title', 'Chi tiết đơn hàng'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="mb-4 text-center">📄 Chi tiết đơn hàng</h2>

    <!-- 🔙 Nút quay lại -->
    <div class="mb-4 text-start">
        <a href="<?php echo e(route('client.orders.index')); ?>" class="btn btn-outline-secondary rounded-pill">
            ← Quay lại danh sách đơn hàng
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <div class="d-flex justify-content-between">
                <div><strong>Mã đơn hàng:</strong> #<?php echo e($order->order_id ?? $order->id); ?></div>
                <div><strong>Ngày đặt:</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?></div>
            </div>
        </div>
        <div class="card-body bg-light rounded-bottom-4">
            <ul class="list-group list-group-flush mb-3">
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?php echo e($item->variant->product->name ?? 'Sản phẩm'); ?></strong><br>
                            <small>Đơn giá: <?php echo e(number_format($item->price)); ?>đ</small><br>
                            <small>Số lượng: x<?php echo e($item->quantity); ?></small>
                        </div>
                        <span class="text-end text-success fw-semibold">
                            <?php echo e(number_format($item->price * $item->quantity)); ?>đ
                        </span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="row mb-2">
                <div class="col-md-6">
                    <p><strong>Phương thức thanh toán:</strong> <?php echo e($order->payment_method ?? 'Không rõ'); ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Trạng thái:</strong>
                        <?php
                            $statusColors = [
                                'pending' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                            $color = $statusColors[$order->status] ?? 'secondary';
                        ?>
                        <span class="badge bg-<?php echo e($color); ?>">
                            <?php echo e(ucfirst($order->status)); ?>

                        </span>
                    </p>
                </div>
            </div>

            <div class="text-end">
                <strong class="fs-5">Tổng tiền:
                    <span class="text-danger">
                        <?php echo e(number_format($order->total_amount)); ?>đ
                    </span>
                </strong>
            </div>

            <?php if($order->status === 'pending'): ?>
                <div class="text-end mt-4">
                    <form action="<?php echo e(route('client.orders.cancel', ['order' => $order->order_id])); ?>" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn huỷ đơn hàng này?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="btn btn-outline-danger">
                            ❌ Huỷ đơn hàng
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/orders/show.blade.php ENDPATH**/ ?>
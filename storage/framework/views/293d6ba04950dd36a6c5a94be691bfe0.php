<?php $__env->startSection('title', 'Đơn hàng của tôi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="mb-4 text-center">🛒 Đơn hàng của tôi</h2>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info text-center rounded-3">
            Bạn chưa có đơn hàng nào.
        </div>
    <?php else: ?>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $statusText = match ($order->status) {
                    'pending' => '⏳ Chờ xác nhận',
                    'confirmed' => '✅ Đã xác nhận',
                    'processing' => '📦 Đang chuẩn bị hàng',
                    'shipping' => '🚚 Đang giao hàng',
                    'delivered' => '📬 Đã giao',
                    'completed' => '🎉 Hoàn tất',
                    'cancelled' => '❌ Đã huỷ',
                    'refunded' => '💸 Đã hoàn tiền',
                    default => '❔ Không rõ',
                };

                $badgeClass = match ($order->status) {
                    'pending' => 'bg-warning text-dark',
                    'confirmed', 'processing', 'shipping' => 'bg-info text-dark',
                    'delivered', 'completed' => 'bg-success',
                    'cancelled', 'refunded' => 'bg-danger',
                    default => 'bg-secondary',
                };
            ?>

            <div class="card mb-4 shadow-sm border-0 rounded-4">
                <div class="card-header <?php echo e($badgeClass); ?> d-flex justify-content-between align-items-center rounded-top-4">
                    <div>
                        <strong>Mã đơn hàng: #<?php echo e($order->order_id); ?></strong><br>
                        <small>🕒 <?php echo e($order->created_at->format('d/m/Y H:i')); ?></small>
                    </div>
                    <span class="badge px-3 py-2 <?php echo e($badgeClass); ?>">
                        <?php echo e($statusText); ?>

                    </span>
                </div>

                <div class="card-body bg-light rounded-bottom-4">
                    
                    <ul class="list-group list-group-flush mb-3">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>📦 <?php echo e($item->variant->product->name ?? 'Sản phẩm'); ?></strong><br>
                                    <small class="text-muted">Đơn giá: <?php echo e(number_format($item->price)); ?>đ</small><br>
                                    <small class="text-muted">Số lượng: x<?php echo e($item->quantity); ?></small>
                                </div>
                                <span class="text-end text-success fw-semibold">
                                    <?php echo e(number_format($item->price * $item->quantity)); ?>đ
                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>💳 Phương thức thanh toán:</strong>
                            <span class="text-uppercase"><?php echo e($order->payment_method); ?></span>
                        </div>
                        <div class="fs-5">
                            <strong>Tổng tiền:</strong>
                            <span class="text-danger fw-bold">
                                <?php echo e(number_format($order->total_amount)); ?>đ
                            </span>
                        </div>
                    </div>

                    
                    <div class="text-end mt-4">
                        <a href="<?php echo e(route('client.orders.show', $order->order_id)); ?>" class="btn btn-outline-dark btn-sm me-2">
                            🔍 Xem chi tiết
                        </a>

                        <?php if(in_array($order->status, ['pending'])): ?>
                            
                            <form action="<?php echo e(route('client.orders.cancel', $order->order_id)); ?>" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Bạn chắc chắn muốn huỷ đơn hàng này?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    ❌ Huỷ đơn hàng
                                </button>
                            </form>
                        <?php elseif($order->status === 'cancelled'): ?>
                            
                            <form action="<?php echo e(route('client.orders.destroy', $order->order_id)); ?>" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Bạn có chắc muốn xoá đơn hàng này không?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    🗑️ Xoá đơn hàng
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/client/orders/index.blade.php ENDPATH**/ ?>
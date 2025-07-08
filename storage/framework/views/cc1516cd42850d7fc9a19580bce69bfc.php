<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết đơn hàng #<?php echo e($order->order_id); ?></h3>
                    </div>
                    <div class="card-body">
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Thông tin khách hàng</h5>
                                <p><strong>Họ tên:</strong> <?php echo e($order->user?->name ?? 'Không rõ'); ?></p>
                                <p><strong>Email:</strong> <?php echo e($order->user?->email ?? 'Không rõ'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin đơn hàng</h5>
                                <p><strong>Trạng thái:</strong>
                                    <span class="badge bg-<?php echo e($order->status_badge_class); ?>">
                                                        <?php echo e($order->status_text); ?>

                                                    </span>
                                </p>
                                <p><strong>Hình thức thanh toán:</strong> <?php echo e($order->payment_method); ?></p>
                                <p><strong>Ngày đặt hàng:</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>

                        
                        <h5>Sản phẩm đã đặt</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->variant?->name ?? 'Không rõ'); ?></td>
                                            <td><?php echo e(number_format($item->price, 0, ',', '.')); ?>₫</td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td><?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?>₫</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                        <td><strong><?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>₫</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        
                        <div class="mt-4">
                            <h5>Cập nhật trạng thái đơn hàng</h5>
                            <form action="<?php echo e(route('admin.orders.update-status', $order)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <div class="input-group" style="max-width: 300px;">
                                    <select name="status" class="form-select">
                                        <option value="pending" <?php echo e($order->status === 'pending' ? 'selected' : ''); ?>>Chờ
                                            xác nhận</option>
                                        <option value="confirmed" <?php echo e($order->status === 'confirmed' ? 'selected' : ''); ?>>Đã
                                            xác nhận</option>
                                        <option value="processing" <?php echo e($order->status === 'processing' ? 'selected' : ''); ?>>
                                            Đang chuẩn bị hàng</option>
                                        <option value="shipping" <?php echo e($order->status === 'shipping' ? 'selected' : ''); ?>>Đang
                                            giao</option>
                                        <option value="delivered" <?php echo e($order->status === 'delivered' ? 'selected' : ''); ?>>Đã
                                            giao</option>
                                        <option value="completed" <?php echo e($order->status === 'completed' ? 'selected' : ''); ?>>Đã
                                            hoàn tất</option>
                                        <option value="cancelled" <?php echo e($order->status === 'cancelled' ? 'selected' : ''); ?>>Đã
                                            hủy</option>
                                        <option value="refunded" <?php echo e($order->status === 'refunded' ? 'selected' : ''); ?>>Đã
                                            hoàn tiền</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>
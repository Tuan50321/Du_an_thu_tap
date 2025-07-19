<?php $__env->startSection('title', 'Thanh toán'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4">Thông tin thanh toán</h2>

    
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('client.checkout.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name ?? '')); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control" required><?php echo e(old('address')); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block mb-2">Phương thức thanh toán</label>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_cod"
                            value="cod" <?php echo e(old('payment_method', 'cod') == 'cod' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="payment_cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay"
                            value="vnpay" <?php echo e(old('payment_method') == 'vnpay' ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="payment_vnpay">
                            VNPay (Chuyển hướng thanh toán)
                        </label>
                    </div>

                    
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
            </div>

            
            <div class="col-md-6">
                <h4>Đơn hàng của bạn</h4>
                <ul class="list-group mb-3">
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?php echo e($item->product->name); ?></h6>
                                <small class="text-muted">x<?php echo e($item->quantity); ?></small>
                            </div>
                            <span class="text-muted"><?php echo e(number_format($item->price * $item->quantity)); ?> đ</span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Tổng cộng</strong></span>
                        <strong><?php echo e(number_format($total)); ?> đ</strong>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <h4 class="text-success mb-3">🎉 Cảm ơn bạn đã đặt hàng!</h4>
        <p>Chúng tôi sẽ sớm liên hệ để xác nhận đơn.</p>
        <a href="<?php echo e(route('client.home')); ?>" class="btn btn-primary mt-3 px-4">Về trang chủ</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    <?php if(session('order_success')): ?>
        $(document).ready(function () {
            $('#orderSuccessModal').modal('show');
        });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/orders/checkout.blade.php ENDPATH**/ ?>
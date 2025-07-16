<?php $__env->startSection('title', 'Đặt hàng thành công'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="bg-white p-5 shadow rounded text-center" style="max-width: 500px; width: 100%;">
        <div class="text-success mb-4" style="font-size: 48px;">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h2 class="fw-bold mb-3">Đặt hàng thành công!</h2>
        <p>Cảm ơn bạn đã mua sắm tại Aurora.<br>Đơn hàng của bạn đã được ghi nhận và sẽ được xử lý trong thời gian sớm nhất.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="<?php echo e(route('client.home')); ?>" class="btn btn-dark">Về trang chủ</a>
            
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/client/orders/success-message.blade.php ENDPATH**/ ?>
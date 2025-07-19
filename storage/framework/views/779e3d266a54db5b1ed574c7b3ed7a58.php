<?php $__env->startSection('title', 'Cảm ơn bạn đã đặt hàng'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="text-center">
            <h2 class="mb-4 text-success">🎉 Cảm ơn bạn đã đặt hàng!</h2>
            <p class="mb-4">Chúng tôi sẽ liên hệ với bạn sớm để xác nhận đơn hàng.</p>
            <a href="<?php echo e(route('client.home')); ?>" class="btn btn-primary px-4">Về trang chủ</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/client/orders/thankyou.blade.php ENDPATH**/ ?>
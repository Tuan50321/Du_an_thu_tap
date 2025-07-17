<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="<?php echo e(route('client.profile.index')); ?>" class="list-group-item list-group-item-action active">
                    <i class="fas fa-user"></i> Thông tin tài khoản
                </a>
                <a href="<?php echo e(route('client.profile.edit')); ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-edit"></i> Cập nhật thông tin
                </a>
                <a href="<?php echo e(route('client.profile.password')); ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-lock"></i> Đổi mật khẩu
                </a>
            </div>
        </div>

        <!-- Nội dung profile -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thông tin tài khoản</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Họ tên:</strong> <?php echo e(Auth::user()->name); ?></p>
                            <p><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></p>
                            <p><strong>Số điện thoại:</strong> <?php echo e(Auth::user()->profile->phone ?? 'Chưa cập nhật'); ?></p>
                            <p><strong>Ngày sinh:</strong> <?php echo e(Auth::user()->profile->birthday ? Auth::user()->profile->birthday->format('d/m/Y') : 'Chưa cập nhật'); ?></p>
                            <p><strong>Giới tính:</strong> <?php echo e(Auth::user()->profile->gender ? (Auth::user()->profile->gender == 1 ? 'Nam' : 'Nữ') : 'Chưa cập nhật'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tỉnh/Thành phố:</strong> <?php echo e(Auth::user()->profile->province ?? 'Chưa cập nhật'); ?></p>
                            <p><strong>Quận/Huyện:</strong> <?php echo e(Auth::user()->profile->district ?? 'Chưa cập nhật'); ?></p>
                            <p><strong>Phường/Xã:</strong> <?php echo e(Auth::user()->profile->ward ?? 'Chưa cập nhật'); ?></p>
                            <p><strong>Đường:</strong> <?php echo e(Auth::user()->profile->street ?? 'Chưa cập nhật'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/client/profile/index.blade.php ENDPATH**/ ?>
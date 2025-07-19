<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="<?php echo e(route('client.profile.index')); ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-user"></i> Thông tin tài khoản
                </a>
                <a href="<?php echo e(route('client.profile.edit')); ?>" class="list-group-item list-group-item-action active">
                    <i class="fas fa-edit"></i> Cập nhật thông tin
                </a>
                <a href="<?php echo e(route('client.profile.password')); ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-lock"></i> Đổi mật khẩu
                </a>
            </div>
        </div>

        <!-- Form cập nhật thông tin -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật thông tin tài khoản</h4>
                    
                    <form action="<?php echo e(route('client.profile.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ tên</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e(Auth::user()->name); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo e(Auth::user()->profile->phone ?? ''); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo e(Auth::user()->profile->birthday ? Auth::user()->profile->birthday->format('Y-m-d') : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Giới tính</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Chọn giới tính</option>
                                        <option value="1" <?php echo e(Auth::user()->profile->gender == 1 ? 'selected' : ''); ?>>Nam</option>
                                        <option value="0" <?php echo e(Auth::user()->profile->gender == 0 ? 'selected' : ''); ?>>Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="province">Tỉnh/Thành phố</label>
                                    <input type="text" class="form-control" id="province" name="province" value="<?php echo e(Auth::user()->profile->province ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="district">Quận/Huyện</label>
                                    <input type="text" class="form-control" id="district" name="district" value="<?php echo e(Auth::user()->profile->district ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ward">Phường/Xã</label>
                                    <input type="text" class="form-control" id="ward" name="ward" value="<?php echo e(Auth::user()->profile->ward ?? ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="street">Đường</label>
                                    <input type="text" class="form-control" id="street" name="street" value="<?php echo e(Auth::user()->profile->street ?? ''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/profile/edit.blade.php ENDPATH**/ ?>
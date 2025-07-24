<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Chỉnh sửa người dùng</h1>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Form chỉnh sửa -->
            <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Ảnh đại diện -->
                <div class="form-group text-center mb-4">
                    <label for="image_profile" class="form-label">Ảnh đại diện</label>
                    <?php if($user->image_profile): ?>
                        <img src="<?php echo e(asset('storage/' . $user->image_profile)); ?>" alt="Ảnh đại diện"
                             class="rounded-circle mb-3" style="max-height: 150px;">
                    <?php else: ?>
                        <img src="<?php echo e(asset('default-avatar.png')); ?>" alt="Ảnh đại diện" class="rounded-circle mb-3"
                             style="max-height: 150px;">
                    <?php endif; ?>
                    <input type="file" name="image_profile" id="image_profile" class="form-control">
                </div>

                <!-- Thông tin người dùng -->
                <div class="form-group mb-3">
                    <label for="name">Tên người dùng</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone_number">Số điện thoại</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?php echo e(old('phone_number', $user->phone_number)); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="birthday">Ngày sinh</label>
                    <input type="date" name="birthday" id="birthday" class="form-control"
                           value="<?php echo e(old('birthday', $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '')); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="gender">Giới tính</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="male" <?php echo e(old('gender', $user->gender) === 'male' ? 'selected' : ''); ?>>Nam</option>
                        <option value="female" <?php echo e(old('gender', $user->gender) === 'female' ? 'selected' : ''); ?>>Nữ</option>
                        <option value="other" <?php echo e(old('gender', $user->gender) === 'other' ? 'selected' : ''); ?>>Khác</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="is_active">Trạng thái</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1" <?php echo e(old('is_active', $user->is_active) == 1 ? 'selected' : ''); ?>>Hoạt động</option>
                        <option value="0" <?php echo e(old('is_active', $user->is_active) == 0 ? 'selected' : ''); ?>>Không hoạt động</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="roles">Vai trò</label>
                    <select name="roles[]" id="roles" class="form-control" multiple>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>" <?php echo e($user->roles->pluck('id')->contains($role->id) ? 'selected' : ''); ?>>
                                <?php echo e($role->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <?php
                    $defaultAddress = $user->addresses->where('is_default', true)->first() ?? $user->addresses->first();
                ?>

                <div class="form-group mb-3">
                    <label for="address_line">Địa chỉ chi tiết</label>
                    <input type="text" name="address_line" id="address_line" class="form-control"
                           value="<?php echo e(old('address_line', $defaultAddress->address_line ?? '')); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="ward">Phường</label>
                    <input type="text" name="ward" id="ward" class="form-control"
                           value="<?php echo e(old('ward', $defaultAddress->ward ?? '')); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="district">Quận</label>
                    <input type="text" name="district" id="district" class="form-control"
                           value="<?php echo e(old('district', $defaultAddress->district ?? '')); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="city">Thành phố</label>
                    <input type="text" name="city" id="city" class="form-control"
                           value="<?php echo e(old('city', $defaultAddress->city ?? '')); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="is_default">Mặc định</label>
                    <select name="is_default" id="is_default" class="form-control">
                        <option value="1" <?php echo e(old('is_default', $defaultAddress->is_default ?? false) == true ? 'selected' : ''); ?>>Có</option>
                        <option value="0" <?php echo e(old('is_default', $defaultAddress->is_default ?? false) == false ? 'selected' : ''); ?>>Không</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>
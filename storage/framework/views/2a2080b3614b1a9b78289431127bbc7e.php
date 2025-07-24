<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Chi tiết người dùng</h1>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Ảnh đại diện -->
            <div class="text-center mb-4">
                <?php if($user->image_profile): ?>
                    <img src="<?php echo e(asset('storage/' . $user->image_profile)); ?>" alt="Ảnh đại diện" class="rounded-circle" style="max-height: 150px;">
                <?php else: ?>
                    <img src="<?php echo e(asset('default-avatar.png')); ?>" alt="Ảnh đại diện" class="rounded-circle" style="max-height: 150px;">
                <?php endif; ?>
            </div>

            <!-- Thông tin người dùng -->
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?php echo e($user->id); ?></td>
                    </tr>
                    <tr>
                        <th>Tên người dùng</th>
                        <td><?php echo e($user->name); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo e($user->email); ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td><?php echo e($user->phone_number ?? 'Không có'); ?></td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td><?php echo e($user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'Không có'); ?></td>
                    </tr>
                    <tr>
                        <th>Giới tính</th>
                        <td>
                            <?php switch($user->gender):
                                case ('male'): ?> Nam <?php break; ?>
                                <?php case ('female'): ?> Nữ <?php break; ?>
                                <?php case ('other'): ?> Khác <?php break; ?>
                                <?php default: ?> Không xác định
                            <?php endswitch; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td><?php echo e($user->is_active ? 'Hoạt động' : 'Không hoạt động'); ?></td>
                    </tr>
                    <tr>
                        <th>Vai trò</th>
                        <td>
                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-primary"><?php echo e($role->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>
                            <?php if($user->addresses->isNotEmpty()): ?>
                                <ul>
                                    <?php $__currentLoopData = $user->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <?php echo e($address->address_line); ?>,
                                            <?php echo e($address->ward); ?>,
                                            <?php echo e($address->district); ?>,
                                            <?php echo e($address->city); ?>

                                            <span class="badge bg-success">
                                                <?php echo e($address->is_default ? 'Mặc định' : ''); ?>

                                            </span>
                                            <div class="d-inline-block">
                                                <form action="<?php echo e(route('admin.users.addresses.update', ['address' => $address->id])); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="hidden" name="is_default" value="1">
                                                    <button class="btn btn-sm btn-primary">Đặt mặc định</button>
                                                </form>
                                                <form action="<?php echo e(route('admin.users.addresses.destroy', ['address' => $address->id])); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa địa chỉ này?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <p>Không có địa chỉ nào được liên kết với người dùng này.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td><?php echo e($user->created_at ? $user->created_at->format('d/m/Y H:i') : 'Không xác định'); ?></td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật</th>
                        <td><?php echo e($user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'Không xác định'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Thêm địa chỉ mới -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Thêm địa chỉ mới</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.users.addresses.store', $user->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label for="address_line">Địa chỉ</label>
                    <input type="text" id="address_line" name="address_line" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="ward">Phường</label>
                    <input type="text" id="ward" name="ward" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="district">Quận/Huyện</label>
                    <input type="text" id="district" name="district" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="city">Thành phố</label>
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" id="is_default" name="is_default" class="form-check-input">
                    <label for="is_default" class="form-check-label">Đặt làm mặc định</label>
                </div>
                <button type="submit" class="btn btn-success">Thêm địa chỉ</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/users/show.blade.php ENDPATH**/ ?>
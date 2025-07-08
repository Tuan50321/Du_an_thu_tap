<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản lý Bài viết</h1>
            <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm bài viết
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form method="GET" action="<?php echo e(route('admin.news.index')); ?>" class="mb-4 d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control w-auto" placeholder="Tìm tiêu đề...">
            <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tác giả</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th width="200px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->news_id); ?></td>
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e($item->category?->name ?? 'Không có'); ?></td>
                                    <td><?php echo e($item->author?->name ?? 'Không rõ'); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($item->status === 'published' ? 'success' : 'secondary'); ?>">
                                            <?php echo e($item->status === 'published' ? 'Đã đăng' : 'Nháp'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($item->published_at ? $item->published_at->format('d/m/Y H:i') : 'Chưa đăng'); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.news.show', $item)); ?>" class="btn btn-sm btn-info" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.news.edit', $item)); ?>" class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.news.destroy', $item)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')"
                                                title="Xoá">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Không có bài viết nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <?php echo e($news->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Du_an_thu_tap\resources\views/admin/BaiViet/index.blade.php ENDPATH**/ ?>
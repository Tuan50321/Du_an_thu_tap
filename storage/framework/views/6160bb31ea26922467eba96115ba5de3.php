<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản lý Bình luận Bài viết</h1>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Bài viết</th>
                                <th>Người bình luận</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th>Ngày bình luận</th>
                                <th width="180px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($comment->id); ?></td>
                                    <td><?php echo e($comment->news?->title ?? 'Không rõ'); ?></td>
                                    <td><?php echo e($comment->user?->name ?? 'Ẩn danh'); ?></td>
                                    <td class="<?php echo e($comment->is_hidden ? 'text-muted fst-italic' : ''); ?>">
                                        <?php echo e($comment->is_hidden ? '[Đã ẩn] ' : ''); ?><?php echo e($comment->content); ?>

                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($comment->is_hidden ? 'secondary' : 'success'); ?>">
                                            <?php echo e($comment->is_hidden ? 'Đã ẩn' : 'Hiển thị'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($comment->created_at->format('d/m/Y H:i')); ?></td>
                                    <td>
                                        
                                        <form action="<?php echo e(route('admin.news-comments.toggle', $comment->id)); ?>"
                                              method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="btn btn-sm btn-<?php echo e($comment->is_hidden ? 'secondary' : 'warning'); ?>"
                                                    title="<?php echo e($comment->is_hidden ? 'Hiện bình luận' : 'Ẩn bình luận'); ?>">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </form>

                                        
                                        <form action="<?php echo e(route('admin.news-comments.destroy', $comment->id)); ?>"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Bạn có chắc muốn xoá bình luận này không?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xoá">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Không có bình luận nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <?php echo e($comments->links('pagination::bootstrap-5')); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/news/comments.blade.php ENDPATH**/ ?>
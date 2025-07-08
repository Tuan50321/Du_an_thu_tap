<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h2 class="mb-4 text-primary">📝 Sửa bài viết</h2>

        <form action="<?php echo e(route('admin.news.update', $news)); ?>" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow-sm border border-light">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">🏷️ Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $news->title)); ?>"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">📂 Danh mục bài viết <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->category_id); ?>"
                                <?php echo e(old('category_id', $news->category_id) == $category->category_id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">✍️ Tác giả</label>
                <select class="form-select" disabled>
                    <option value="<?php echo e(Auth::id()); ?>" selected>
                        <?php echo e(Auth::user()->name); ?>

                    </option>
                </select>
                <input type="hidden" name="author_id" value="<?php echo e(Auth::id()); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">🖼️ Ảnh đại diện hiện tại</label><br>
                <?php if($news->image): ?>
                    <img src="<?php echo e(asset($news->image)); ?>" alt="Ảnh hiện tại" class="img-thumbnail" width="200">
                <?php else: ?>
                    <p class="text-muted fst-italic">Chưa có ảnh</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">📷 Chọn ảnh mới (nếu muốn thay)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">📝 Nội dung <span class="text-danger">*</span></label>
                <textarea name="content" id="editor" class="form-control" rows="18" required><?php echo e(old('content', $news->content)); ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">📢 Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="published" <?php echo e(old('status', $news->status) === 'published' ? 'selected' : ''); ?>>Đã
                            đăng</option>
                        <option value="draft" <?php echo e(old('status', $news->status) === 'draft' ? 'selected' : ''); ?>>Nháp
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">📅 Ngày đăng</label>
                    <div class="form-control bg-light">
                        <?php echo e($news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Chưa có ngày đăng'); ?>

                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-secondary">← Quay lại</a>
                <button type="submit" class="btn btn-success">💾 Cập nhật</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 400,
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=<?php echo e(csrf_token()); ?>',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=<?php echo e(csrf_token()); ?>'
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/admin/news/edit.blade.php ENDPATH**/ ?>
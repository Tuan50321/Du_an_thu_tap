

<?php $__env->startSection('title', $news->title . ' - HOUSE HOLD GOOD'); ?>

<?php $__env->startSection('content'); ?>
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <!-- Bài viết -->
                <div class="col-lg-8">
                    <h1 class="fw-bold mb-3"><?php echo e($news->title); ?></h1>

                    <div class="mb-3 text-muted small">
                        <i class="fas fa-user me-1"></i><?php echo e($news->author->name ?? 'Không rõ'); ?> |
                        <i class="fas fa-calendar-alt mx-1"></i><?php echo e(optional($news->published_at)->format('d/m/Y')); ?> |
                        <i class="fas fa-folder mx-1"></i><?php echo e($news->category->name ?? 'Không phân loại'); ?>

                    </div>

                    <?php if($news->image): ?>
                        <div class="mb-4">
                            <img src="<?php echo e(asset($news->image)); ?>" class="img-fluid rounded w-100"
                                style="max-height: 450px; object-fit: cover;" alt="<?php echo e($news->title); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="mb-4 lead">
                        <?php echo e($news->summary); ?>

                    </div>

                    <div class="content">
                        <?php echo $news->content; ?>

                    </div>

                    <div class="mt-5">
                        <a href="<?php echo e(route('client.news.index')); ?>" class="btn btn-outline-secondary">
                            ← Quay lại danh sách
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Danh mục -->
                    <div class="card mb-4 shadow-sm rounded-4 border-0 overflow-hidden">
                        <div class="card-header bg-primary text-white fw-semibold py-3 px-4 fs-5">
                            🗂 Danh mục bài viết
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="list-group-item px-4 py-2">
                                    <a href="#" class="text-decoration-none text-dark">
                                        <i class="fas fa-angle-right me-1 text-primary"></i> <?php echo e($cat->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item text-muted px-4">Không có danh mục</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Bài viết mới -->
                    <div class="card mb-4 shadow-sm rounded-4 border-0 overflow-hidden">
                        <div class="card-header bg-secondary text-white fw-semibold py-3 px-4 fs-5">
                            📰 Bài viết mới
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="list-group-item px-4 py-2">
                                    <a href="<?php echo e(route('client.news.show', ['news' => $item->news_id])); ?>"
                                        class="text-decoration-none text-dark d-block">
                                        <i class="fas fa-newspaper me-1 text-success"></i> <?php echo e($item->title); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item text-muted px-4">Không có bài viết mới</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Bình luận -->
                    <div class="comments-section mt-5">
                        <h4 class="fw-bold mb-4 border-bottom pb-2">
                            💬 Bình luận (<?php echo e($news->comments->count()); ?>)
                        </h4>

                        <!-- Danh sách bình luận -->
                        <?php $__empty_1 = true; $__currentLoopData = $news->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="mb-4 ps-3 border-start border-3 border-primary">
                                <div class="fw-semibold text-primary">
                                    <?php echo e($comment->user->name ?? 'Khách'); ?>

                                </div>
                                <div class="text-muted small">
                                    <?php echo e($comment->created_at->format('d/m/Y H:i')); ?>

                                </div>
                                <p class="mt-2 mb-0"><?php echo e($comment->content); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted fst-italic">Chưa có bình luận nào.</p>
                        <?php endif; ?>

                        <!-- Form gửi bình luận -->
                        <div class="mt-5">
                            <h5 class="mb-3">✍️ Gửi bình luận của bạn</h5>
                            <form action="<?php echo e(route('client.news.comment', $news->news_id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <textarea name="content" class="form-control" rows="3" required placeholder="Nội dung bình luận..."><?php echo e(old('content')); ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Gửi bình luận
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/Baiviet/show.blade.php ENDPATH**/ ?>
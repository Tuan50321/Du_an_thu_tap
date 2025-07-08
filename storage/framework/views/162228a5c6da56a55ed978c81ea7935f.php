<?php $__env->startSection('title', 'Tin tức - HOUSE HOLD GOOD'); ?>

<?php $__env->startSection('content'); ?>
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-5 text-center fw-bold">Tin tức mới nhất</h2>
            <div class="row">
                <!-- Cột bài viết chính -->
                <div class="col-lg-8">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php $__empty_1 = true; $__currentLoopData = $newsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    <?php if($news->image): ?>
                                        <img src="<?php echo e(asset($news->image)); ?>" class="card-img-top" alt="<?php echo e($news->title); ?>"
                                            style="height: 180px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold"><?php echo e($news->title); ?></h6>
                                        <p class="card-text small text-muted">
                                            <?php echo e(\Illuminate\Support\Str::limit($news->summary, 90)); ?>

                                        </p>

                                        
                                        <a href="<?php echo e(route('client.news.show', ['news' => $news->news_id])); ?>"
                                            class="btn btn-sm btn-outline-primary mt-2">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                    <div
                                        class="card-footer bg-white border-0 small text-muted d-flex justify-content-between">
                                        <span>Đăng bởi: <strong><?php echo e($news->author->name ?? 'Không rõ'); ?></strong></span>
                                        <span><?php echo e(optional($news->published_at)->format('d/m/Y')); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <div class="alert alert-info">Hiện chưa có bài viết nào.</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Phân trang -->
                    <div class="mt-4 d-flex justify-content-center">
                        <?php echo e($newsList->links()); ?>

                    </div>
                </div>

                <!-- Cột danh mục + bài viết mới -->
                <div class="col-lg-4">

                    <!-- Danh mục -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header bg-primary text-white py-3 rounded-top-4">
                            <h6 class="mb-0 fs-5">
                                <i class="fas fa-folder me-2"></i>Danh mục
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="list-group-item px-4 py-2">
                                    <a href="#" class="text-decoration-none text-dark d-block">
                                        <i class="fas fa-angle-right text-primary me-2"></i><?php echo e($cat->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item text-muted px-4 py-2">Không có danh mục</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Bài viết mới -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-secondary text-white py-3 rounded-top-4">
                            <h6 class="mb-0 fs-5">
                                <i class="fas fa-newspaper me-2"></i>Bài viết mới
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="list-group-item px-4 py-2">
                                    <a href="<?php echo e(route('client.news.show', ['news' => $item->news_id])); ?>"
                                        class="text-decoration-none text-dark d-block">
                                        <i class="fas fa-chevron-right me-2 text-success"></i><?php echo e($item->title); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="list-group-item text-muted px-4 py-2">Không có bài viết mới</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Du_an_thu_tap\Du_an_thu_tap\resources\views/client/news/index.blade.php ENDPATH**/ ?>
<nav id="sidebar">
    <div class="p-4">
        <h4 class="text-white">Admin Panel</h4>
        <hr class="bg-light">
        <ul class="list-unstyled">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-primary' : ''); ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-primary' : ''); ?>">
                    <i class="fas fa-list"></i> Categories
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.brands.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.brands.*') ? 'bg-primary' : ''); ?>">
                    <i class="fas fa-tags"></i> Brands
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.products.*') ? 'bg-primary' : ''); ?>">
                    <i class="fas fa-box"></i> Products
                </a>
            </li>
            <li>
            <a href="<?php echo e(route('admin.banners.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.banners.*') ? 'bg-primary' : ''); ?>">
                <i class="fas fa-image"></i> Banners
            </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH D:\laragon\www\Du_an_thu_tap\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>
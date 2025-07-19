<nav id="sidebar">
    <div class="p-3">
        <h4 class="text-white">Bảng Quản Trị</h4>
        <hr class="bg-light">
        <ul class="list-unstyled">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-home"></i> Trang chủ
                </a>
            </li>

            <li>
                <a class="sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#userMenu" role="button"
                    aria-expanded="false">
                    <span><i class="fas fa-users"></i> Quản lý người dùng</span>
                    <i class="fas fa-chevron-down small"></i>
                </a>
                <div class="collapse" id="userMenu">
                    <ul class="nav flex-column ms-3 mt-2">
                        <li>
                            <a href="{{ route('admin.users.admins') }}" class="sidebar-link">
                                <i class="fas fa-user"></i> Admin
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.staffs') }}" class="sidebar-link">
                                <i class="fas fa-user"></i> Staff
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.customers') }}" class="sidebar-link">
                                <i class="fas fa-user"></i> Customer
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li>
                <a class="sidebar-link d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#roleMenu" role="button"
                    aria-expanded="false">
                    <span><i class="fas fa-users"></i> Quản lý phân quyền</span>
                    <i class="fas fa-chevron-down small"></i>
                </a>
                <div class="collapse" id="roleMenu">
                    <ul class="nav flex-column ms-3 mt-2">
                        <li>
                            <a href="{{ route('admin.roles.index') }}" class="sidebar-link">
                                <i class="fas fa-user"></i> Vai trò
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permissions.index') }}" class="sidebar-link">
                                <i class="fas fa-user"></i> Phân quyền
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li>
                <a href="{{ route('admin.categories.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-list"></i> Danh mục sản phẩm
                </a>
            </li>

            <li>
                <a href="{{ route('admin.brands.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.brands.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-tags"></i> Thương hiệu
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-box"></i> Sản phẩm
                </a>
            </li>

            <li>
                <a href="{{ route('admin.banners.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.banners.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-image"></i> Banner
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-shopping-cart"></i> Đơn hàng
                </a>
            </li>

            <li>
                <a href="{{ route('admin.coupons.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.coupons.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-ticket-alt"></i> Mã giảm giá
                </a>
            </li>

            {{-- Quản lý bài viết --}}
            <li>
                <a class="sidebar-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.news-categories.*', 'admin.news.*') ? 'bg-primary text-white' : '' }}"
                    data-bs-toggle="collapse" href="#newsMenu" role="button"
                    aria-expanded="{{ request()->routeIs('admin.news-categories.*', 'admin.news.*') ? 'true' : 'false' }}">
                    <span><i class="fas fa-newspaper"></i> Quản lý bài viết</span>
                    <i class="fas fa-chevron-down small"></i>
                </a>

                <div class="collapse {{ request()->routeIs('admin.news-categories.*', 'admin.news.*') ? 'show' : '' }}"
                    id="newsMenu">
                    <ul class="nav flex-column ms-3 mt-2">
                        <li>
                            <a href="{{ route('admin.news-categories.index') }}"
                                class="sub-nav-link {{ request()->routeIs('admin.news-categories.*') ? 'text-primary' : '' }}">
                                <i class="fas fa-folder"></i> Danh mục bài viết
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.news.index') }}"
                                class="sub-nav-link {{ request()->routeIs('admin.news.*') ? 'text-primary' : '' }}">
                                <i class="fas fa-file-alt"></i> Bài viết
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.news-comments.index') }}"
                                class="sub-nav-link {{ request()->routeIs('admin.news-comments.*') ? 'text-primary fw-bold' : '' }}">
                                <i class="fas fa-comments"></i> Bình luận bài viết
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('admin.reviews.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.reviews.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-star"></i> Đánh giá
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contacts.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-envelope"></i> Liên hệ
                </a>
            </li>

            <li>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-cog"></i> Cài đặt
                </a>
            </li>

            <li>
                <a href="#" class="sidebar-link">
                    <i class="fas fa-chart-bar"></i> Báo cáo
                </a>
            </li>
        </ul>
    </div>
</nav>

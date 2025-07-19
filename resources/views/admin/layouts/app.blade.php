<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">



    <style>
        #sidebar {
            min-height: 100vh;
            width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
        }

        #content {
            width: calc(100% - 250px);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .sidebar-link {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .sidebar-link:hover {
            background: #495057;
            color: #fff;
            text-decoration: none;
        }

        .sidebar-link i {
            margin-right: 10px;
        }

        .sidebar-link {
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
        }

        .sidebar-link:hover,
        .sidebar-link.bg-primary {
            color: #fff;
            background-color: #0d6efd;
            border-radius: 4px;
        }

        .sub-nav-link {
            display: block;
            padding: 6px 10px;
            color: #ddd;
            text-decoration: none;
        }

        .sub-nav-link:hover {
            color: #fff;
        }

        .pagination-wrapper nav {
            padding: 8px 16px;
            background-color: #fff;
            border-radius: 10px;
        }

        /* Làm nút bo tròn và đậm hơn */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        /* Hiệu ứng hover mềm mại hơn */
        .btn:hover,
        .btn:focus {
            opacity: 0.9;
            transform: scale(1.02);
        }

        /* Các nút nhỏ dùng trong bảng */
        .btn-sm {
            padding: 0.35rem 0.6rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.4rem;
        }

        /* Nút soft dùng màu nhạt nhưng hover rõ */
        .btn-soft-primary {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border: none;
        }

        .btn-soft-primary:hover {
            background-color: rgba(13, 110, 253, 0.2);
            color: #0b5ed7;
        }

        .btn-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: none;
        }

        .btn-soft-danger:hover {
            background-color: rgba(220, 53, 69, 0.2);
            color: #bb2d3b;
        }

        .sidebar-nav a:hover {
            background-color: #0d6efd !important;
            color: #fff !important;
        }
    </style>


</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="btn btn-dark" id="sidebarCollapse">

                    </button>

                    <div class="dropdown">
                        @auth
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                            </a>
                        @endauth
                    </div>

                </div>
            </nav>

            <!-- Main Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                if ($('#sidebar').hasClass('active')) {
                    $('#sidebar').css('width', '80px');
                    $('#content').css('width', 'calc(100% - 80px)');
                } else {
                    $('#sidebar').css('width', '250px');
                    $('#content').css('width', 'calc(100% - 250px)');
                }
            });
        });
    </script>

    @yield('scripts')

</body>

</html>

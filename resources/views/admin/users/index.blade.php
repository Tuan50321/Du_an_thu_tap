@extends('admin.layouts.app')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="container mt-4">

        <!-- Thông báo -->
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                <!-- Nút thêm -->
                <div class="mb-3 d-flex justify-content-end">
                    <a href="{{ route('admin.users.create') }}"
                        class="btn btn-outline-success d-flex align-items-center gap-1" title="Thêm người dùng mới">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                        <span class="d-none d-sm-inline">Thêm</span>
                    </a>

                </div>

                <!-- Form tìm kiếm -->
                <form action="" method="get" class="row g-3 mb-3">
                    <div class="col-auto">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm người dùng"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm" title="Tìm kiếm">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </form>

                <!-- Bảng người dùng -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @switch($user->role)
                                            @case('admin')
                                                <span class="badge bg-danger d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-shield-lock-fill"></i> Admin
                                                </span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-person"></i> User
                                                </span>
                                        @endswitch
                                    </td>


                                    <td>
                                        <div class="d-flex justify-content-center gap-2">

                                            <!-- Sửa -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Sửa người dùng">
                                                <i class="fa-solid fa-pen"></i>

                                            </a>


                                            <!-- Xóa -->
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                    title="Xóa người dùng">
                                                    <i class="bi bi-trash3-fill fs-5 "></i>
                                                </button>
                                            </form>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($users->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Không có người dùng nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Kích hoạt tooltip --}}
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
            });
        </script>
    @endpush
@endsection

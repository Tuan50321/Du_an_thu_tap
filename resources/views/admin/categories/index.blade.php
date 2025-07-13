@extends('admin.layouts.app')

@section('title', 'Danh sách danh mục')

@push('styles')
    <style>
        .pagination-wrapper nav {
            padding: 8px 16px;
            background-color: #fff;
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-3 px-md-5 mt-4">
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

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <!-- Nút thêm -->
                <div class="mb-3 d-flex justify-content-end flex-wrap gap-2">
                    <a href="{{ route('admin.categories.create') }}"
                        class="btn btn-outline-success d-flex align-items-center gap-1" title="Thêm danh mục mới">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                        <span class="d-none d-sm-inline">Thêm</span>
                    </a>
                </div>

                <!-- Form tìm kiếm -->
                <form action="" method="get" class="row row-cols-1 row-cols-sm-auto g-2 align-items-center mb-3">
                    <div class="col">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm" title="Tìm kiếm">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </form>

                <!-- Bảng danh mục -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Danh mục cha</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                                    <td>
                                        <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $category->status ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Xem -->
                                            <a href="{{ route('admin.categories.show', $category->category_id) }}"
                                                class="btn btn-outline-info btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Xem chi tiết">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            
                                            <!-- Sửa -->
                                            <a href="{{ route('admin.categories.edit', $category->category_id) }}"
                                                class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Sửa danh mục">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            
                                            <!-- Xóa -->
                                            <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                    title="Xóa danh mục"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-box-seam fs-1 mb-2"></i>
                                            <p class="mb-0">Không có danh mục nào</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="pagination-wrapper mt-3 text-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
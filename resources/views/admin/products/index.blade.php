@extends('admin.layouts.app')

@section('title', 'Danh sách sản phẩm')

@push('styles')
    <style>
        .pagination-wrapper nav {
            padding: 8px 16px;
            background-color: #fff;
            border-radius: 10px;
        }

        .product-thumbnail {
            max-width: 30px !important;
            max-height: 30px !important;
            object-fit: cover;
            border-radius: 4px;
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
                    <a href="{{ route('admin.products.create') }}"
                        class="btn btn-outline-success d-flex align-items-center gap-1" title="Thêm sản phẩm mới">
                        <i class="bi bi-plus-circle-fill fs-5"></i>
                        <span class="d-none d-sm-inline">Thêm</span>
                    </a>
                </div>

                <!-- Form tìm kiếm -->
                <form action="" method="get" class="row row-cols-1 row-cols-sm-auto g-2 align-items-center mb-3">
                    <div class="col">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm" title="Tìm kiếm">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </form>

                <!-- Bảng sản phẩm -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th>Giá bán</th>
                                <th>Số lượng tồn</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}"
                                            class="product-thumbnail"
                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>{{ $product->product_id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '' }}</td>
                                    <td>
                                        @if ($product->brand)
                                            <a href="{{ route('admin.brands.show', ['brand_id' => $product->brand_id]) }}"
                                                class="text-decoration-none" title="Xem chi tiết thương hiệu">
                                                {{ $product->brand->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">Không có</span>
                                        @endif
                                    </td>

                                    <td>{{ number_format($product->price) }}đ</td>
                                    <td>
                                        @if ($product->stock == 0)
                                            <span class="badge bg-danger">Hết hàng</span>
                                        @elseif($product->stock < 5)
                                            <span class="badge bg-warning">Sắp hết</span>
                                        @else
                                            <span class="badge bg-success">Còn hàng</span>
                                        @endif
                                        <span class="ms-2">{{ $product->stock }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $product->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->status ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->creator->name ?? '' }}</td>
                                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Xem -->
                                            <a href="{{ route('admin.products.show', $product->product_id) }}"
                                                class="btn btn-outline-info btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Xem chi tiết">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <!-- Sửa -->
                                            <a href="{{ route('admin.products.edit', $product->product_id) }}"
                                                class="btn btn-outline-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                title="Sửa sản phẩm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <!-- Xóa -->
                                            <form action="{{ route('admin.products.destroy', $product->product_id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 36px; height: 36px;" data-bs-toggle="tooltip"
                                                    title="Xóa sản phẩm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-box-seam fs-1 mb-2"></i>
                                            <p class="mb-0">Không có sản phẩm nào</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="pagination-wrapper mt-3 text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

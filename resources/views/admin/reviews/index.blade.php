@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản lý Đánh giá</h1>
            {{-- Có thể thêm nút tạo nếu cần --}}
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.reviews.index') }}" class="mb-4 d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control w-auto"
                placeholder="Tìm theo nội dung...">
            <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Sản phẩm</th>
                                <th>Điểm</th>
                                <th>Nội dung</th>
                                <th>Duyệt</th>
                                <th>Ngày tạo</th>
                                <th width="150px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->review_id }}</td>
                                    <td>{{ $item->user?->name ?? 'Không rõ' }}</td>
                                    <td>{{ $item->product?->name ?? 'Không rõ' }}</td>
                                    <td>{{ $item->rating }}/5</td>
                                    <td>{{ $item->content }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->is_approved ? 'success' : 'secondary' }}">
                                            {{ $item->is_approved ? 'Hiển thị' : 'Đã ẩn' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at?->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.reviews.toggle', $item->review_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm btn-{{ $item->is_approved ? 'warning' : 'secondary' }}"
                                                title="{{ $item->is_approved ? 'Ẩn đánh giá' : 'Hiện đánh giá' }}">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.reviews.show', $item) }}" class="btn btn-sm btn-info"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- Xóa đánh giá --}}
                                        <form action="{{ route('admin.reviews.destroy', $item->review_id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Không có đánh giá nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $reviews->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

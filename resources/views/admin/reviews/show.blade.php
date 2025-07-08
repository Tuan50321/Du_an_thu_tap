@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Chi tiết đánh giá #{{ $review->review_id }}</h1>

        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Người dùng</dt>
                    <dd class="col-sm-9">{{ $review->user?->name ?? 'Không rõ' }}</dd>

                    <dt class="col-sm-3">Sản phẩm</dt>
                    <dd class="col-sm-9">{{ $review->product?->name ?? 'Không rõ' }}</dd>

                    <dt class="col-sm-3">Điểm đánh giá</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-info">{{ $review->rating }}/5</span>
                    </dd>

                    <dt class="col-sm-3">Nội dung</dt>
                    <dd class="col-sm-9">{{ $review->content }}</dd>

                    <dt class="col-sm-3">Trạng thái duyệt</dt>
                    <dd class="col-sm-9">
                        @if ($review->is_approved)
                            <span class="badge bg-success">Đã duyệt</span>
                        @else
                            <span class="badge bg-secondary">Chưa duyệt</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Ngày tạo</dt>
                    <dd class="col-sm-9">{{ $review->created_at->format('d/m/Y H:i') }}</dd>
                </dl>

                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại danh sách
                </a>
                <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Chỉnh sửa
                </a>
            </div>
        </div>
    </div>
@endsection

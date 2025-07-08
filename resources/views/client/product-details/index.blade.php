@extends('client.layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white p-2 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        {{-- Chi tiết sản phẩm --}}
        <div class="row mt-4">
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid rounded shadow-sm w-100"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-7">
                <h1 class="fw-bold mb-3">{{ $product->name }}</h1>
                <p class="text-muted mb-1">Thương hiệu: <strong>{{ $product->brand->name ?? 'N/A' }}</strong></p>
                <p class="mb-3">Danh mục: <strong>{{ $product->category->name ?? 'N/A' }}</strong></p>

                <div class="mb-3">
                    <h3 class="text-danger fw-bold">
                        {{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}₫
                    </h3>
                </div>

                {{-- Tùy chọn sản phẩm --}}
                <div class="row g-2">
                    @if ($colors->isNotEmpty())
                        <div class="col-6">
                            <label class="form-label">Màu sắc:</label>
                            <select class="form-select">
                                <option>Chọn màu</option>
                                @foreach ($colors as $color)
                                    <option>{{ ucfirst($color) }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if ($materials->isNotEmpty())
                        <div class="col-6">
                            <label class="form-label">Chất liệu:</label>
                            <select class="form-select">
                                <option>Chọn chất liệu</option>
                                @foreach ($materials as $material)
                                    <option>{{ ucfirst($material) }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                 {{-- Mô tả chi tiết --}}
                <div class="mt-4">
                    <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
                    <div class="p-3 rounded bg-light shadow-sm" style="line-height: 1.7;">
                        {!! nl2br(e($product->description ?: 'Sản phẩm chất lượng cao, thiết kế tinh tế, đáp ứng nhu cầu sử dụng hàng ngày của bạn.')) !!}
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary w-50">
                        <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                    </button>
                    <button class="btn btn-danger w-50">
                        <i class="fas fa-bolt"></i> Mua ngay
                    </button>
                </div>
            </div>
        </div>

        {{-- Mô tả sản phẩm --}}
        <div class="mt-5">
            <h4 class="fw-bold">Mô tả sản phẩm</h4>
            <div class="bg-light rounded p-3 shadow-sm">
                {!! nl2br(e($product->description ?: 'Không có mô tả chi tiết.')) !!}
            </div>
        </div>

        {{-- Đánh giá --}}
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Đánh giá từ người dùng</h4>

            @php
                $approvedReviews = $product->reviews->where('is_approved', true)->sortByDesc('created_at');
            @endphp


            @if ($approvedReviews->isEmpty())
                <div class="alert alert-info">Chưa có đánh giá nào cho sản phẩm này.</div>
            @else
                <div class="list-group">
                    @foreach ($approvedReviews as $review)
                        <div class="list-group-item mb-2 rounded shadow-sm">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $review->user->name ?? 'Ẩn danh' }}</strong>
                                <small>{{ $review->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div>
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star text-warning"></i>
                                @endfor
                            </div>
                            <p>{{ $review->content }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Gửi đánh giá --}}
            @auth
                <div class="card mt-4">
                    <div class="card-header">Gửi đánh giá của bạn</div>
                    <div class="card-body">
                        <form action="{{ route('client.reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Đánh giá của bạn <span class="text-danger">*</span></label>
                                <div class="star-rating d-flex gap-1">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="rating" value="{{ $i }}"
                                            id="star{{ $i }}">
                                        <label for="star{{ $i }}"><i class="fa fa-star"></i></label>
                                    @endfor
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Nội dung:</label>
                                <textarea name="content" class="form-control" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mt-4">
                    Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để gửi đánh giá.
                </div>
            @endauth
        </div>

        {{-- Sản phẩm liên quan --}}
        @if ($relatedProducts->isNotEmpty())
            <div class="mt-5">
                <h4 class="fw-bold">Sản phẩm liên quan</h4>
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    @foreach ($relatedProducts as $related)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <a href="{{ route('client.product.details', $related->product_id) }}">
                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" class="card-img-top"
                                        alt="{{ $related->name }}" style="height: 200px; object-fit: cover;">
                                </a>
                                <div class="card-body p-2">
                                    <h6 class="card-title text-truncate">{{ $related->name }}</h6>
                                    <p class="text-danger fw-bold">
                                        {{ number_format($related->discount_price ?? $related->price, 0, ',', '.') }}₫
                                    </p>
                                    <a href="{{ route('client.product.details', $related->product_id) }}"
                                        class="btn btn-sm btn-outline-primary w-100">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

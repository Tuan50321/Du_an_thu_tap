@extends('client.layouts.app')

@section('title', $product->name)

@push('styles')
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            min-width: 300px;
            margin-bottom: 10px;
        }

        .toast-success {
            background-color: #6c757d;
            border-color: #5a6268;
            color: #ffffff;
        }

        .toast-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
@endpush

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
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid rounded shadow-sm"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                <p class="text-muted mb-2">Thương hiệu: {{ $product->brand->name ?? 'N/A' }}</p>
                <p class="mb-3">Danh mục: {{ $product->category->name ?? 'N/A' }}</p>
                <p class="mb-3">Số lượng còn lại: <span class="badge bg-info">{{ $product->stock }}</span></p>
                <h4 class="text-danger fw-bold mb-3">
                    {{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}₫
                </h4>

                {{-- Số lượng --}}
                <div class="mb-3" style="width: 120px;">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                        class="form-control" id="quantityDisplay">
                </div>

                {{-- Nút thêm vào giỏ hàng --}}
                <form method="POST" action="{{ route('client.cart.add') }}" class="add-to-cart-form mt-3"
                    id="addToCartForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="quantity" value="1" id="quantityInput">
                    <input type="hidden" name="price" value="{{ $product->discount_price ?? $product->price }}">
                    @if ($product->stock <= 0)
                        <button type="button" class="btn btn-secondary" disabled>
                            <i class="fa fa-shopping-cart"></i> Hết hàng
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary" id="addToCartBtn">
                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                        </button>
                    @endif
                </form>

                {{-- JavaScript để cập nhật số lượng --}}
                <script>
                    $(document).ready(function() {
                        // Cập nhật số lượng khi thay đổi
                        $('#quantityDisplay').on('change', function() {
                            $('#quantityInput').val($(this).val());
                        });

                        // Xử lý form thêm vào giỏ hàng
                        $('#addToCartForm').on('submit', function(e) {
                            e.preventDefault();

                            var form = $(this);
                            var btn = $('#addToCartBtn');
                            var originalText = btn.html();

                            // Disable button và hiển thị loading
                            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang thêm...');

                            $.ajax({
                                url: form.attr('action'),
                                method: 'POST',
                                data: form.serialize(),
                                success: function(response) {
                                    if (response.success) {
                                        showToast('success', 'Đã thêm sản phẩm vào giỏ hàng');
                                        // Reset form
                                        $('#quantityDisplay').val(1);
                                        $('#quantityInput').val(1);
                                        // Cập nhật số lượng giỏ hàng
                                        updateCartCount(response.cart_count);
                                    } else {
                                        showToast('error', response.message ||
                                            'Có lỗi xảy ra khi thêm sản phẩm');
                                    }
                                },
                                error: function(xhr) {
                                    showToast('error', xhr.responseJSON ? xhr.responseJSON.message :
                                        'Có lỗi xảy ra');
                                },
                                complete: function() {
                                    // Enable button và khôi phục text
                                    btn.prop('disabled', false).html(originalText);
                                }
                            });
                        });
                    });

                    // Hàm hiển thị toast
                    function showToast(type, message) {
                        var toastClass = type === 'success' ? 'toast-success' : 'toast-error';
                        var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

                        var toast = `
                        <div class="toast ${toastClass} border-0 shadow" role="alert" style="display: block;">
                            <div class="toast-header">
                                <i class="fa ${icon} me-2"></i>
                                <strong class="me-auto">${type === 'success' ? 'Thành công' : 'Lỗi'}</strong>
                                <button type="button" class="btn-close" onclick="$(this).closest('.toast').remove()"></button>
                            </div>
                            <div class="toast-body">
                                ${message}
                            </div>
                        </div>
                    `;

                        $('#toastContainer').append(toast);

                        setTimeout(function() {
                            $('.toast').fadeOut(function() {
                                $(this).remove();
                            });
                        }, 3000);
                    }

                    // Cập nhật số lượng giỏ hàng
                    function updateCartCount(count) {
                        $('.cart-count').text(count);
                    }
                </script>

                {{-- Mô tả chi tiết --}}
                <div class="mt-4">
                    <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
                    <div class="p-3 rounded bg-light shadow-sm" style="line-height: 1.7;">
                        {!! nl2br(
                            e($product->description ?: 'Sản phẩm chất lượng cao, thiết kế tinh tế, đáp ứng nhu cầu sử dụng hàng ngày của bạn.'),
                        ) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Đánh giá sản phẩm --}}
        <!-- Form đánh giá -->
        <div class="mt-4 p-4 rounded border shadow-sm bg-white">
            <h5 class="fw-bold mb-3">Đánh giá sản phẩm</h5>
            <form action="{{ route('client.reviews.store') }}" method="POST" class="rating-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                <div class="star-rating mb-3">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                        <label for="star{{ $i }}" title="{{ $i }} sao">&#9733;</label>
                    @endfor
                </div>

                <textarea name="content" class="form-control mb-3 rounded" rows="4"
                    placeholder="Hãy để lại bình luận của bạn tại đây!" required></textarea>

                <button type="submit" class="btn btn-danger rounded px-4">Gửi đánh giá</button>
            </form>
        </div>

        <!-- Hiển thị đánh giá đã có -->
        <div class="mt-5 p-4 rounded border bg-white shadow-sm">
            <h5 class="fw-bold mb-3">Đánh giá của khách hàng</h5>

            @php
                $reviews = $product->reviews()->where('is_approved', 1)->latest()->get();
                $reviewCount = $reviews->count();
                $avgRating = $reviewCount ? round($reviews->avg('rating'), 1) : 0;
            @endphp

            <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <span class="fs-1 fw-bold text-warning">{{ $avgRating }}</span>
                    <span class="text-muted">/ 5</span>
                </div>
                <div>
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= $avgRating ? 's' : 'r' }} fa-star text-warning"></i>
                    @endfor
                    <div class="text-muted small">{{ $reviewCount }} lượt đánh giá</div>
                </div>
            </div>

            @forelse ($reviews as $review)
                <div class="border-top pt-3 mt-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <strong>{{ $review->user->name ?? 'Khách' }}</strong>
                        <span class="text-muted small">{{ $review->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star text-warning"></i>
                        @endfor
                    </div>
                    <p class="mb-0">{{ $review->content }}</p>
                </div>
            @empty
                <p class="text-muted">Chưa có đánh giá nào.</p>
            @endforelse
        </div>


        {{-- Sản phẩm liên quan --}}
        @if ($relatedProducts->isNotEmpty())
            <div class="mt-5">
                <h4 class="fw-bold mb-3">Sản phẩm liên quan</h4>
                <div class="row row-cols-2 row-cols-md-4 g-4">
                    @foreach ($relatedProducts as $related)
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <a href="{{ route('client.product.details', $related->product_id) }}">
                                    <img src="{{ asset('storage/' . $related->thumbnail) }}" class="card-img-top"
                                        alt="{{ $related->name }}" style="object-fit: cover; height: 200px;">
                                </a>
                                <div class="card-body p-2">
                                    <h6 class="card-title mb-1 text-truncate">{{ $related->name }}</h6>
                                    <p class="text-danger fw-bold mb-1">
                                        {{ number_format($related->discount_price ?? $related->price, 0, ',', '.') }}₫
                                    </p>
                                    <a href="{{ route('client.product.details', $related->product_id) }}"
                                        class="btn btn-sm btn-outline-primary w-100">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

{{-- Toast Container --}}
<div class="toast-container" id="toastContainer"></div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            // Cập nhật số lượng khi người dùng thay đổi
            $('#quantityDisplay').on('change', function() {
                $('#quantityInput').val($(this).val());
            });

            // Xử lý form thêm vào giỏ hàng
            $('#addToCartForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var btn = $('#addToCartBtn');
                var originalText = btn.html();

                // Disable button và hiển thị loading
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang thêm...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('success', 'Đã thêm sản phẩm vào giỏ hàng');
                            // Reset form
                            $('#quantityDisplay').val(1);
                            $('#quantityInput').val(1);
                            // Cập nhật số lượng giỏ hàng
                            if (response.cart_count !== undefined) {
                                updateCartCount(response.cart_count);
                            }
                        } else {
                            showToast('error', response.message ||
                                'Có lỗi xảy ra khi thêm sản phẩm');
                        }
                    },
                    error: function(xhr) {
                        var message = 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        showToast('error', message);
                    },
                    complete: function() {
                        // Enable button và khôi phục text
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });

            // Hàm hiển thị toast
            function showToast(type, message) {
                var toastClass = type === 'success' ? 'toast-success' : 'toast-error';
                var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

                var toast = `
            <div class="toast ${toastClass} border-0 shadow" role="alert" style="display: block;">
                <div class="toast-header">
                    <i class="fa ${icon} me-2"></i>
                    <strong class="me-auto">${type === 'success' ? 'Thành công' : 'Lỗi'}</strong>
                    <button type="button" class="btn-close" onclick="$(this).closest('.toast').remove()"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;

                $('#toastContainer').append(toast);

                // Tự động ẩn sau 3 giây
                setTimeout(function() {
                    $('.toast').fadeOut(function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    </script>
@endpush

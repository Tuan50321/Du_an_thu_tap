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
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid rounded shadow-sm"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                <p class="text-muted mb-2">Thương hiệu: {{ $product->brand->name ?? 'N/A' }}</p>
                <p class="mb-3">Danh mục: {{ $product->category->name ?? 'N/A' }}</p>
                <h4 class="text-danger fw-bold mb-3">
                    {{ number_format($product->discount_price ?? $product->price, 0, ',', '.') }}₫
                </h4>

                {{-- Chọn RAM --}}
                @if ($rams->isNotEmpty())
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn RAM:</label>
                        <select class="form-select" name="ram">
                            <option value="">Chọn RAM</option>
                            @foreach ($rams as $ram)
                                <option value="{{ $ram }}">{{ $ram }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Chọn ROM --}}
                @if ($roms->isNotEmpty())
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn ROM:</label>
                        <select class="form-select" name="rom">
                            <option value="">Chọn ROM</option>
                            @foreach ($roms as $rom)
                                <option value="{{ $rom }}">{{ $rom }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Chọn Màu --}}
                @if ($colors->isNotEmpty())
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn màu:</label>
                        <select class="form-select" name="color">
                            <option value="">Chọn màu</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Chọn Chất liệu --}}
                @if ($materials->isNotEmpty())
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Chọn chất liệu:</label>
                        <select class="form-select" name="material">
                            <option value="">Chọn chất liệu</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material }}">{{ ucfirst($material) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Số lượng --}}
                <div class="mb-3" style="width: 120px;">
                    <input type="number" name="quantity" value="1" min="1" class="form-control">
                </div>

                 {{-- Mô tả chi tiết --}}
                <div class="mt-4">
                    <h5 class="fw-bold mb-2">Mô tả sản phẩm</h5>
                    <div class="p-3 rounded bg-light shadow-sm" style="line-height: 1.7;">
                        {!! nl2br(e($product->description ?: 'Sản phẩm chất lượng cao, thiết kế tinh tế, đáp ứng nhu cầu sử dụng hàng ngày của bạn.')) !!}
                    </div>
                </div>
                <br>

                {{-- Nút --}}
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-bolt"></i> Mua ngay
                    </button>
                </div>
            </div>
        </div>

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
                                <img src="{{ asset('storage/' . $related->thumbnail) }}"
                                     class="card-img-top"
                                     alt="{{ $related->name }}"
                                     style="object-fit: cover; height: 200px;">
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

@endsection

@extends('client.layouts.app')

@section('title', 'Sản phẩm - HOUSE HOLD GOOD')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="fw-bold">Tất Cả Sản Phẩm Gia Dụng</h1>
                <p class="text-muted">Khám phá và lựa chọn sản phẩm phù hợp nhất cho ngôi nhà của bạn.</p>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('client.products.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="category_id" class="form-label">Lọc theo danh mục</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">Tất cả danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="brand_id" class="form-label">Lọc theo thương hiệu</label>
                            <select name="brand_id" id="brand_id" class="form-select">
                                <option value="">Tất cả thương hiệu</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->brand_id }}" {{ request('brand_id') == $brand->brand_id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="sort" class="form-label">Sắp xếp theo</label>
                            <select name="sort" id="sort" class="form-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">Lọc</button>
                                @if(request()->hasAny(['category_id', 'brand_id', 'sort']))
                                    <a href="{{ route('client.products.index') }}" class="btn btn-outline-secondary" title="Bỏ lọc">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-md-6 col-lg-3">
                    <div class="card product-card h-100">
                        <a href="{{ route('client.product.details', ['id' => $product->product_id]) }}">
                            <img src="{{ $product->thumbnail_url }}" class="card-img-top product-image"
                                alt="{{ $product->name }}"></a>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ $product->name }}</h6>
                            <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-danger fw-bold">{{ number_format($product->price) }} VNĐ</span>
                                    @if ($product->old_price)
                                        <span class="text-muted text-decoration-line-through">{{ number_format($product->old_price) }} VNĐ</span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <form method="POST" class="add-to-cart-form w-100">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="price" value="{{ $product->discount_price ?? $product->price }}">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">
                                            <i class="fas fa-shopping-cart me-1"></i> Thêm vào giỏ
                                        </button>
                                    </form>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="fs-4">Không tìm thấy sản phẩm nào phù hợp.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.add-to-cart-form').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                let btn = form.find('button');
                let originalText = btn.html();

                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    url: "{{ route('client.cart.add') }}",
                    method: 'POST',
                    data: form.serialize(),
                    success: function (res) {
                        if (res.success) {
                            alert('Đã thêm vào giỏ hàng!');
                            $('.cart-count').text(res.cart_count ?? 0);
                        } else {
                             alert(res.message || 'Có lỗi xảy ra!');
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                             alert('Vui lòng đăng nhập để thêm vào giỏ hàng.');
                            setTimeout(() => {
                                window.location.href = "{{ route('login') }}";
                            }, 1500);
                        } else {
                             alert('Thêm sản phẩm vào giỏ thất bại!');
                        }
                    },
                    complete: function () {
                        btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
@endsection
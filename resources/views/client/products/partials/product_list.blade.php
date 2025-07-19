{{-- File: resources/views/client/products/partials/product_list.blade.php --}}
<div class="row g-4">
    @forelse ($products as $product)
        <div class="col-md-6 col-lg-4">
            <div class="card product-card h-100">
                {{-- Huy hiệu giảm giá --}}
                @if ($product->discount_price > 0 && $product->discount_price < $product->price)
                    <div class="sale-badge">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</div>
                @endif
                <a href="{{ route('client.product.details', ['id' => $product->product_id]) }}">
                    <img src="{{ $product->thumbnail_url }}" class="card-img-top product-image" alt="{{ $product->name }}">
                </a>
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                             @if($product->discount_price > 0 && $product->discount_price < $product->price)
                                <span class="text-danger fw-bold">{{ number_format($product->discount_price) }} VNĐ</span>
                                <span class="text-muted text-decoration-line-through small">{{ number_format($product->price) }} VNĐ</span>
                             @else
                                <span class="fw-bold">{{ number_format($product->price) }} VNĐ</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="fs-4 text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-5">
    {{ $products->links() }}
</div>```

### **Bước 3: Thiết kế lại toàn bộ trang `products/index.blade.php`**

Đây là phần chính, nơi chúng ta áp dụng tất cả các cải tiến. Thay thế toàn bộ nội dung file `resources/views/client/products/index.blade.php` bằng code dưới đây.

```html
@extends('client.layouts.app')

@section('title', 'Sản phẩm - HOUSE HOLD GOOD')

{{-- Thêm CSS cho thanh trượt giá và các hiệu ứng --}}
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css" />
<style>
    /* ----- Product Card Polish ----- */
    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #e9ecef;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .product-card .product-image {
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }
    .sale-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #ff9900;
        color: white;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: bold;
        z-index: 10;
    }

    /* ----- Sidebar Filters ----- */
    .filter-sidebar .list-group-item {
        cursor: pointer;
        border: none;
        padding: 0.75rem 1rem;
    }
    .filter-sidebar .list-group-item:hover, .filter-sidebar .list-group-item.active {
        background-color: #f8f9fa;
        color: #ff9900;
        font-weight: bold;
    }
    .filter-title {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    #price-slider {
        margin: 20px 5px;
    }
    .noUi-connect {
        background: #ff9900;
    }
    #price-values {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 0.9em;
        color: #6c757d;
    }
</style>
@endpush


@section('content')
<div class="container py-5">
    <div class="row">

        <!-- ===== Sidebar Filters ===== -->
        <aside class="col-lg-3">
            <div class="filter-sidebar">
                <!-- Filter by Category -->
                <div class="mb-4">
                    <h5 class="filter-title">Danh mục</h5>
                    <ul class="list-group filter-group" id="filter-category">
                        <li class="list-group-item active" data-id="">Tất cả</li>
                        @foreach ($categories as $category)
                            <li class="list-group-item" data-id="{{ $category->category_id }}">
                                {{ $category->name }}
                                <span class="badge bg-light text-dark rounded-pill float-end">{{ $category->products_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Filter by Brand -->
                <div class="mb-4">
                    <h5 class="filter-title">Thương hiệu</h5>
                    <ul class="list-group filter-group" id="filter-brand">
                        <li class="list-group-item active" data-id="">Tất cả</li>
                        @foreach ($brands as $brand)
                            <li class="list-group-item" data-id="{{ $brand->brand_id }}">
                                {{ $brand->name }}
                                <span class="badge bg-light text-dark rounded-pill float-end">{{ $brand->products_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Filter by Price -->
                <div class="mb-4">
                    <h5 class="filter-title">Lọc theo giá</h5>
                    <div id="price-slider"></div>
                    <div id="price-values">
                        <span id="min-price">0 đ</span>
                        <span id="max-price">10,000,000 đ</span>
                    </div>
                </div>

                <!-- Clear Filters Button -->
                <div class="d-grid">
                    <a href="{{ route('client.products.index') }}" class="btn btn-outline-secondary">Xóa tất cả bộ lọc</a>
                </div>
            </div>
        </aside>

        <!-- ===== Product List ===== -->
        <main class="col-lg-9">
            <!-- Sort and View Options -->
            <header class="d-flex justify-content-between align-items-center mb-4">
                <p class="mb-0 text-muted">Hiển thị {{ $products->firstItem() }}-{{ $products->lastItem() }} của {{ $products->total() }} sản phẩm</p>
                <div class="d-flex align-items-center">
                    <label for="sort-by" class="form-label me-2 mb-0">Sắp xếp:</label>
                    <select class="form-select form-select-sm" id="sort-by" style="width: auto;">
                        <option value="latest">Mới nhất</option>
                        <option value="price_asc">Giá: Thấp đến Cao</option>
                        <option value="price_desc">Giá: Cao đến Thấp</option>
                    </select>
                </div>
            </header>

            <!-- Product Grid (will be updated by AJAX) -->
            <div id="product-list-container">
                @include('client.products.partials.product_list', ['products' => $products])
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
<script>
$(document).ready(function() {
    // --- Price Slider Setup ---
    var priceSlider = document.getElementById('price-slider');
    noUiSlider.create(priceSlider, {
        start: [0, 10000000], // Mặc định từ 0 đến 10 triệu
        connect: true,
        step: 50000,
        range: {
            'min': 0,
            'max': 10000000
        },
        format: {
            to: function (value) { return Math.round(value); },
            from: function (value) { return Number(value); }
        }
    });

    var minPrice = document.getElementById('min-price');
    var maxPrice = document.getElementById('max-price');

    priceSlider.noUiSlider.on('update', function (values, handle) {
        if (handle === 0) {
            minPrice.innerHTML = formatCurrency(values[0]) + ' đ';
        } else {
            maxPrice.innerHTML = formatCurrency(values[1]) + ' đ';
        }
    });

    priceSlider.noUiSlider.on('change', function(values, handle) { // 'change' event fires when user stops sliding
        fetchProducts();
    });

    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN').format(number);
    }

    // --- AJAX Product Filtering ---
    let filters = {
        category_id: '',
        brand_id: '',
        sort: 'latest',
        min_price: 0,
        max_price: 10000000,
        page: 1
    };

    function fetchProducts() {
        // Update price from slider
        let priceValues = priceSlider.noUiSlider.get();
        filters.min_price = priceValues[0];
        filters.max_price = priceValues[1];

        // Show loading indicator (optional)
        $('#product-list-container').css('opacity', 0.5);

        // Build URL
        let url = new URL('{{ route("client.products.index") }}');
        Object.keys(filters).forEach(key => url.searchParams.append(key, filters[key]));

        // Update browser URL without reloading
        window.history.pushState({path:url.href}, '', url.href);

        $.ajax({
            url: url.toString(),
            type: 'GET',
            success: function(data) {
                $('#product-list-container').html(data).css('opacity', 1);
            },
            error: function() {
                 $('#product-list-container').html('<p>Đã xảy ra lỗi. Vui lòng thử lại.</p>').css('opacity', 1);
            }
        });
    }

    // -- Event Listeners ---
    // Category & Brand filters
    $('.filter-group .list-group-item').on('click', function() {
        let $this = $(this);
        let filterType = $this.closest('.filter-group').attr('id').split('-')[1] + '_id'; // 'category_id' or 'brand_id'

        $this.siblings().removeClass('active');
        $this.addClass('active');

        filters[filterType] = $this.data('id');
        filters.page = 1; // Reset to first page
        fetchProducts();
    });

    // Sort filter
    $('#sort-by').on('change', function() {
        filters.sort = $(this).val();
        filters.page = 1; // Reset to first page
        fetchProducts();
    });

    // Pagination links
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let pageUrl = new URL($(this).attr('href'));
        filters.page = pageUrl.searchParams.get('page');
        fetchProducts();
    });

     // Handle Add to Cart via AJAX (re-attach event after product list is reloaded)
     $(document).on('submit', '.add-to-cart-form', function(e) {
        e.preventDefault();
        let form = $(this);
        // (Your existing AJAX add-to-cart logic here)
        // ...
        alert('Đã thêm sản phẩm (logic AJAX cần được tích hợp)!');
    });
});
</script>
@endpush
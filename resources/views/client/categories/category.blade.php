@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar filter -->
        <div class="col-md-3 mb-4">
            <form method="GET" action="">
                <div class="card mb-3">
                    <div class="card-header">Lọc theo giá</div>
                    <div class="card-body">
                        @php
                            $priceRanges = [
                                ['label' => 'Dưới 200.000đ', 'min' => 0, 'max' => 200000],
                                ['label' => '200.000đ - 500.000đ', 'min' => 200000, 'max' => 500000],
                                ['label' => '500.000đ - 1.000.000đ', 'min' => 500000, 'max' => 1000000],
                                ['label' => 'Trên 1.000.000đ', 'min' => 1000000, 'max' => null],
                            ];
                            $selectedRange = null;
                            foreach ($priceRanges as $i => $range) {
                                if (request('min_price') == $range['min'] && request('max_price') == $range['max']) {
                                    $selectedRange = $i;
                                }
                            }
                        @endphp
                        @foreach($priceRanges as $i => $range)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="price_range" id="price_range_{{ $i }}" value="{{ $i }}"
                                    @if($selectedRange === $i) checked @endif
                                    onclick="
                                        document.querySelector('[name=min_price]').value = '{{ $range['min'] }}';
                                        document.querySelector('[name=max_price]').value = '{{ $range['max'] ?? '' }}';
                                        this.form.submit();
                                    ">
                                <label class="form-check-label" for="price_range_{{ $i }}">{{ $range['label'] }}</label>
                            </div>
                        @endforeach
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">Thương hiệu</div>
                    <div class="card-body">
                        <select name="brand_id" class="form-select">
                            <option value="">Tất cả</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand_id }}" {{ request('brand_id') == $brand->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </form>
        </div>
        <!-- Product list -->
        <div class="col-md-9">
            <h3 class="mb-4">Danh mục: {{ $category->name }}</h3>
            <div class="row g-3">
                @forelse($products as $product)
                    <div class="col-md-4 col-6">
                        <div class="card product-card h-100">
                            <img src="{{ $product->thumbnail_url }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text mb-1">
                                    <span class="fw-bold text-danger">{{ number_format($product->display_price, 0, ',', '.') }} đ</span>
                                    @if($product->is_discounted)
                                        <span class="text-muted text-decoration-line-through ms-2">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                                    @endif
                                </p>
                                <p class="mb-0"><small>Thương hiệu: {{ $product->brand->name ?? 'Không rõ' }}</small></p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Không có sản phẩm nào phù hợp.</div>
                    </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .product-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .product-card .card-img-top {
        height: 220px;
        object-fit: cover;
        background: #f8f9fa;
    }
    .product-card .card-body {
        flex: 1 1 auto;
        min-height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
</style>
@endsection 
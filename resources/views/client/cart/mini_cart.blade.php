<div id="mini-cart-sidebar" class="mini-cart-sidebar">
    <div class="mini-cart-header">
        <h5>Giỏ hàng</h5>
        <button onclick="$('#mini-cart-sidebar').removeClass('show')" class="btn-close">×</button>
    </div>
    <div class="mini-cart-body">
        @if($cart && $cart->items->count())
            <ul class="list-unstyled">
                @foreach($cart->items as $item)
                    <li class="d-flex align-items-center mb-2">
                        @php
                            $thumbnail = $item->product->thumbnail ?? 'default-thumbnail.jpg';
                            $thumbnailPath = asset('storage/products/thumbnails/' . $thumbnail);
                        @endphp
                        <img src="{{ $thumbnailPath }}" width="50" class="me-2" style="object-fit:cover;">
                        <div>
                            <div>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</div>
                            <small>{{ number_format($item->price) }}₫ x {{ $item->quantity }}</small>
                            <small class="text-muted">Thumbnail: {{ $thumbnail }}</small>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mini-cart-total mb-2">
                Tổng: <b>{{ number_format($cart->total) }}₫</b>
            </div>
            <a href="{{ route('client.cart.index') }}" class="btn btn-primary w-100 mt-2">Xem chi tiết giỏ hàng</a>
        @else
            <div>Giỏ hàng trống.</div>
        @endif
    </div>
</div>
<style>
.mini-cart-sidebar { position:fixed; top:0; right:-400px; width:350px; height:100%; background:#fff; box-shadow:-2px 0 8px #ccc; z-index:9999; transition: right 0.3s; }
.mini-cart-sidebar.show { right:0; }
.mini-cart-header { display:flex; justify-content:space-between; align-items:center; padding:10px; border-bottom:1px solid #eee; }
.mini-cart-body { padding:10px; }
.btn-close { background:none; border:none; font-size:1.5rem; line-height:1; }
</style> 
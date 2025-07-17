@extends('client.layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">📄 Chi tiết đơn hàng</h2>

    <!-- 🔙 Nút quay lại -->
    <div class="mb-4 text-start">
        <a href="{{ route('client.orders.index') }}" class="btn btn-outline-secondary rounded-pill">
            ← Quay lại danh sách đơn hàng
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <div class="d-flex justify-content-between">
                <div><strong>Mã đơn hàng:</strong> #{{ $order->order_id ?? $order->id }}</div>
                <div><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>
        <div class="card-body bg-light rounded-bottom-4">
            <ul class="list-group list-group-flush mb-3">
                @foreach ($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $item->variant->product->name ?? 'Sản phẩm' }}</strong><br>
                            <small>Đơn giá: {{ number_format($item->price) }}đ</small><br>
                            <small>Số lượng: x{{ $item->quantity }}</small>
                        </div>
                        <span class="text-end text-success fw-semibold">
                            {{ number_format($item->price * $item->quantity) }}đ
                        </span>
                    </li>
                @endforeach
            </ul>

            <div class="row mb-2">
                <div class="col-md-6">
                    <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method ?? 'Không rõ' }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Trạng thái:</strong>
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                            $color = $statusColors[$order->status] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="text-end">
                <strong class="fs-5">Tổng tiền:
                    <span class="text-danger">
                        {{ number_format($order->total_amount) }}đ
                    </span>
                </strong>
            </div>

            @if ($order->status === 'pending')
                <div class="text-end mt-4">
                    <form action="{{ route('client.orders.cancel', ['order' => $order->order_id]) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn huỷ đơn hàng này?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger">
                            ❌ Huỷ đơn hàng
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

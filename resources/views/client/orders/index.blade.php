@extends('client.layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">🛒 Đơn hàng của tôi</h2>

    @if ($orders->isEmpty())
        <div class="alert alert-info text-center rounded-3">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
        @foreach ($orders as $order)
            @php
                $statusText = match ($order->status) {
                    'pending' => '⏳ Chờ xác nhận',
                    'confirmed' => '✅ Đã xác nhận',
                    'processing' => '📦 Đang chuẩn bị hàng',
                    'shipping' => '🚚 Đang giao hàng',
                    'delivered' => '📬 Đã giao',
                    'completed' => '🎉 Hoàn tất',
                    'cancelled' => '❌ Đã huỷ',
                    'refunded' => '💸 Đã hoàn tiền',
                    default => '❔ Không rõ',
                };

                $badgeClass = match ($order->status) {
                    'pending' => 'bg-warning text-dark',
                    'confirmed', 'processing', 'shipping' => 'bg-info text-dark',
                    'delivered', 'completed' => 'bg-success',
                    'cancelled', 'refunded' => 'bg-danger',
                    default => 'bg-secondary',
                };
            @endphp

            <div class="card mb-4 shadow-sm border-0 rounded-4">
                <div class="card-header {{ $badgeClass }} d-flex justify-content-between align-items-center rounded-top-4">
                    <div>
                        <strong>Mã đơn hàng: #{{ $order->order_id }}</strong><br>
                        <small>🕒 {{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <span class="badge px-3 py-2 {{ $badgeClass }}">
                        {{ $statusText }}
                    </span>
                </div>

                <div class="card-body bg-light rounded-bottom-4">
                    {{-- Danh sách sản phẩm --}}
                    <ul class="list-group list-group-flush mb-3">
                        @foreach ($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>📦 {{ $item->variant->product->name ?? 'Sản phẩm' }}</strong><br>
                                    <small class="text-muted">Đơn giá: {{ number_format($item->price) }}đ</small><br>
                                    <small class="text-muted">Số lượng: x{{ $item->quantity }}</small>
                                </div>
                                <span class="text-end text-success fw-semibold">
                                    {{ number_format($item->price * $item->quantity) }}đ
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Phương thức thanh toán + Tổng tiền --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>💳 Phương thức thanh toán:</strong>
                            <span class="text-uppercase">{{ $order->payment_method }}</span>
                        </div>
                        <div class="fs-5">
                            <strong>Tổng tiền:</strong>
                            <span class="text-danger fw-bold">
                                {{ number_format($order->total_amount) }}đ
                            </span>
                        </div>
                    </div>

                    {{-- Hành động --}}
                    <div class="text-end mt-4">
                        <a href="{{ route('client.orders.show', $order->order_id) }}" class="btn btn-outline-dark btn-sm me-2">
                            🔍 Xem chi tiết
                        </a>

                        @if (in_array($order->status, ['pending']))
                            {{-- Cho phép huỷ nếu chưa xử lý --}}
                            <form action="{{ route('client.orders.cancel', $order->order_id) }}" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Bạn chắc chắn muốn huỷ đơn hàng này?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    ❌ Huỷ đơn hàng
                                </button>
                            </form>
                        @elseif ($order->status === 'cancelled')
                            {{-- Cho phép xoá nếu đã huỷ --}}
                            <form action="{{ route('client.orders.destroy', $order->order_id) }}" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Bạn có chắc muốn xoá đơn hàng này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    🗑️ Xoá đơn hàng
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

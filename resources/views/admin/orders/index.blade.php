@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Quản lý đơn hàng</h3>
                    </div>
                    <div class="card-body">
                        @if ($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Khách hàng</th>
                                            <th>Trạng thái</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Tổng tiền</th>
                                            <th>Ngày đặt</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->order_id }}</td>
                                                <td>{{ $order->user?->name ?? 'Không xác định' }}</td>
                                                @php
                                                    $statusLabels = [
                                                        'pending' => ['label' => 'Chờ xác nhận', 'color' => 'warning'],
                                                        'confirmed' => ['label' => 'Đã xác nhận', 'color' => 'primary'],
                                                        'processing' => ['label' => 'Đang xử lý', 'color' => 'info'],
                                                        'shipping' => ['label' => 'Đang giao', 'color' => 'secondary'],
                                                        'delivered' => ['label' => 'Đã giao', 'color' => 'success'],
                                                        'completed' => ['label' => 'Hoàn tất', 'color' => 'success'],
                                                        'cancelled' => ['label' => 'Đã hủy', 'color' => 'danger'],
                                                        'refunded' => ['label' => 'Đã hoàn tiền', 'color' => 'dark'],
                                                    ];
                                                @endphp

                                                <td>
                                                    <span class="badge bg-{{ $order->status_badge_class }}">
                                                        {{ $order->status_text }}
                                                    </span>
                                                </td>

                                                <td>{{ strtoupper($order->payment_method) }}</td>
                                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} ₫</td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->order_id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> Chi tiết
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        @else
                            <div class="alert alert-info text-center">
                                Không có đơn hàng nào được tìm thấy.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

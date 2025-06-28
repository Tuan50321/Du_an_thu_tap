@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết đơn hàng #{{ $order->order_id }}</h3>
                    </div>
                    <div class="card-body">
                        {{-- Thông tin khách hàng --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Thông tin khách hàng</h5>
                                <p><strong>Họ tên:</strong> {{ $order->user?->name ?? 'Không rõ' }}</p>
                                <p><strong>Email:</strong> {{ $order->user?->email ?? 'Không rõ' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin đơn hàng</h5>
                                <p><strong>Trạng thái:</strong>
                                    <span class="badge bg-{{ $order->status_badge_class }}">
                                                        {{ $order->status_text }}
                                                    </span>
                                </p>
                                <p><strong>Hình thức thanh toán:</strong> {{ $order->payment_method }}</p>
                                <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        {{-- Danh sách sản phẩm --}}
                        <h5>Sản phẩm đã đặt</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $item->variant?->name ?? 'Không rõ' }}</td>
                                            <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                        <td><strong>{{ number_format($order->total_amount, 0, ',', '.') }}₫</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- Cập nhật trạng thái --}}
                        <div class="mt-4">
                            <h5>Cập nhật trạng thái đơn hàng</h5>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="input-group" style="max-width: 300px;">
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Chờ
                                            xác nhận</option>
                                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Đã
                                            xác nhận</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                                            Đang chuẩn bị hàng</option>
                                        <option value="shipping" {{ $order->status === 'shipping' ? 'selected' : '' }}>Đang
                                            giao</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Đã
                                            giao</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Đã
                                            hoàn tất</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Đã
                                            hủy</option>
                                        <option value="refunded" {{ $order->status === 'refunded' ? 'selected' : '' }}>Đã
                                            hoàn tiền</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('client.layouts.app')

@section('title', 'Thanh toán')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Thông tin thanh toán</h2>

    {{-- Hiển thị lỗi --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Hiển thị lỗi validate --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('client.checkout.store') }}">
        @csrf
        <div class="row">
            {{-- THÔNG TIN KHÁCH HÀNG --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block mb-2">Phương thức thanh toán</label>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_cod"
                            value="cod" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                        <label class="form-check-label" for="payment_cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay"
                            value="vnpay" {{ old('payment_method') == 'vnpay' ? 'checked' : '' }}>
                        <label class="form-check-label" for="payment_vnpay">
                            VNPay (Chuyển hướng thanh toán)
                        </label>
                    </div>

                    {{-- Thêm các phương thức khác nếu cần --}}
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận đặt hàng</button>
            </div>

            {{-- TÓM TẮT GIỎ HÀNG --}}
            <div class="col-md-6">
                <h4>Đơn hàng của bạn</h4>
                <ul class="list-group mb-3">
                    @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">x{{ $item->quantity }}</small>
                            </div>
                            <span class="text-muted">{{ number_format($item->price * $item->quantity) }} đ</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Tổng cộng</strong></span>
                        <strong>{{ number_format($total) }} đ</strong>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <h4 class="text-success mb-3">🎉 Cảm ơn bạn đã đặt hàng!</h4>
        <p>Chúng tôi sẽ sớm liên hệ để xác nhận đơn.</p>
        <a href="{{ route('client.home') }}" class="btn btn-primary mt-3 px-4">Về trang chủ</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    @if(session('order_success'))
        $(document).ready(function () {
            $('#orderSuccessModal').modal('show');
        });
    @endif
</script>
@endsection

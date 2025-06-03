@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Chi tiết mã giảm giá</h4>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách
                    </a>
                </div>
                <div class="card-body">

                    <dl class="row">
                        <dt class="col-sm-4">Mã giảm giá</dt>
                        <dd class="col-sm-8">{{ $coupon->code }}</dd>

                        <dt class="col-sm-4">Loại giảm giá</dt>
                        <dd class="col-sm-8">
                            {{ $coupon->discount_type === 'percentage' ? 'Phần trăm' : 'Cố định' }}
                        </dd>

                        <dt class="col-sm-4">Giá trị giảm</dt>
                        <dd class="col-sm-8">
                            {{ $coupon->discount_type === 'percentage' ? $coupon->value . '%' : number_format($coupon->value, 0) . ' ₫' }}
                        </dd>

                        <dt class="col-sm-4">Giảm tối đa</dt>
                        <dd class="col-sm-8">
                            {{ number_format($coupon->max_discount_amount ?? 0, 0) }} ₫
                        </dd>

                        <dt class="col-sm-4">Giá trị đơn hàng tối thiểu</dt>
                        <dd class="col-sm-8">
                            {{ number_format($coupon->min_order_value ?? 0, 0) }} ₫
                        </dd>

                        <dt class="col-sm-4">Giá trị đơn hàng tối đa</dt>
                        <dd class="col-sm-8">
                            {{ number_format($coupon->max_order_value ?? 0, 0) }} ₫
                        </dd>

                        <dt class="col-sm-4">Số lần dùng tối đa mỗi người</dt>
                        <dd class="col-sm-8">
                            {{ $coupon->max_usage_per_user }}
                        </dd>

                        <dt class="col-sm-4">Ngày bắt đầu</dt>
                        <dd class="col-sm-8">
                            {{ \Carbon\Carbon::parse($coupon->start_date)->format('d/m/Y') }}
                        </dd>

                        <dt class="col-sm-4">Ngày kết thúc</dt>
                        <dd class="col-sm-8">
                            {{ \Carbon\Carbon::parse($coupon->end_date)->format('d/m/Y') }}
                        </dd>

                        <dt class="col-sm-4">Trạng thái</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $coupon->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $coupon->status ? 'Đang hoạt động' : 'Ngừng hoạt động' }}
                            </span>
                        </dd>
                    </dl>

                    <div class="text-end mt-3">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa mã này không?')">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

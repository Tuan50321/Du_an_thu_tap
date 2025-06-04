@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Chỉnh sửa mã giảm giá</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="code" class="form-label">Mã giảm giá</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                id="code" name="code" value="{{ old('code', $coupon->code) }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="discount_type" class="form-label">Loại giảm giá</label>
                            <select class="form-select @error('discount_type') is-invalid @enderror"
                                id="discount_type" name="discount_type" required>
                                <option value="">-- Chọn loại --</option>
                                <option value="percentage" {{ old('discount_type', $coupon->discount_type) == 'percentage' ? 'selected' : '' }}>Phần trăm</option>
                                <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : '' }}>Cố định</option>
                            </select>
                            @error('discount_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="value" class="form-label">Giá trị giảm</label>
                            <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror"
                                id="value" name="value" value="{{ old('value', $coupon->value) }}" required>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="max_discount_amount" class="form-label">Giảm tối đa (nếu phần trăm)</label>
                            <input type="number" step="0.01" class="form-control"
                                id="max_discount_amount" name="max_discount_amount" value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}">
                        </div>

                        <div class="mb-3">
                            <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
                            <input type="number" step="0.01" class="form-control"
                                id="min_order_value" name="min_order_value" value="{{ old('min_order_value', $coupon->min_order_value) }}">
                        </div>

                        <div class="mb-3">
                            <label for="max_order_value" class="form-label">Giá trị đơn hàng tối đa</label>
                            <input type="number" step="0.01" class="form-control"
                                id="max_order_value" name="max_order_value" value="{{ old('max_order_value', $coupon->max_order_value) }}">
                        </div>

                        <div class="mb-3">
                            <label for="max_usage_per_user" class="form-label">Số lần dùng tối đa mỗi người</label>
                            <input type="number" class="form-control"
                                id="max_usage_per_user" name="max_usage_per_user" value="{{ old('max_usage_per_user', $coupon->max_usage_per_user) }}">
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ old('start_date', $coupon->start_date) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" value="{{ old('end_date', $coupon->end_date) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="1" {{ old('status', $coupon->status) == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                                <option value="0" {{ old('status', $coupon->status) == '0' ? 'selected' : '' }}>Ngừng hoạt động</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật mã giảm giá
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Mã giảm giá</h1>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm mã mới
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Mã</th>
                                <th>Loại mã</th>
                                <th>Giá trị</th>
                                <th>Giảm tối đa</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th width="200px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->coupon_id }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ ucfirst($coupon->discount_type) }}</td>
                                    <td>
                                        {{ $coupon->discount_type === 'percentage' ? $coupon->value . '%' : number_format($coupon->value, 0) . ' ₫' }}
                                    </td>
                                    <td>{{ number_format($coupon->max_discount_amount ?? 0, 0) }} ₫</td>
                                    <td>{{ $coupon->start_date }}</td>
                                    <td>{{ $coupon->end_date }}</td>
                                    <td>
                                        <span class="badge {{ $coupon->status ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $coupon->status ? 'Đang hoạt động' : 'Ngừng hoạt động' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.coupons.show', $coupon) }}"
                                            class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-warning"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this coupon?')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($coupons->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center">Không tìm thấy mã giảm giá nào.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

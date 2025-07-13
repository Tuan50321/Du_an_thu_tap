@extends('client.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('client.profile.index') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-user"></i> Thông tin tài khoản
                </a>
                <a href="{{ route('client.profile.edit') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-edit"></i> Cập nhật thông tin
                </a>
                <a href="{{ route('client.profile.password') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-lock"></i> Đổi mật khẩu
                </a>
            </div>
        </div>

        <!-- Nội dung profile -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thông tin tài khoản</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Họ tên:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Số điện thoại:</strong> {{ Auth::user()->profile->phone ?? 'Chưa cập nhật' }}</p>
                            <p><strong>Ngày sinh:</strong> {{ Auth::user()->profile->birthday ? Auth::user()->profile->birthday->format('d/m/Y') : 'Chưa cập nhật' }}</p>
                            <p><strong>Giới tính:</strong> {{ Auth::user()->profile->gender ? (Auth::user()->profile->gender == 1 ? 'Nam' : 'Nữ') : 'Chưa cập nhật' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tỉnh/Thành phố:</strong> {{ Auth::user()->profile->province ?? 'Chưa cập nhật' }}</p>
                            <p><strong>Quận/Huyện:</strong> {{ Auth::user()->profile->district ?? 'Chưa cập nhật' }}</p>
                            <p><strong>Phường/Xã:</strong> {{ Auth::user()->profile->ward ?? 'Chưa cập nhật' }}</p>
                            <p><strong>Đường:</strong> {{ Auth::user()->profile->street ?? 'Chưa cập nhật' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

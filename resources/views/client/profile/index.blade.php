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
                            <p><strong>Số điện thoại:</strong> {{ Auth::user()->phone_number ?? 'Chưa cập nhật' }}</p>
                            <p><strong>Ngày sinh:</strong> 
                                {{ Auth::user()->birthday ? \Carbon\Carbon::parse(Auth::user()->birthday)->format('d/m/Y') : 'Chưa cập nhật' }}
                            </p>
                            <p><strong>Giới tính:</strong> 
                                {{ Auth::user()->gender ? (Auth::user()->gender === 'male' ? 'Nam' : (Auth::user()->gender === 'female' ? 'Nữ' : 'Khác')) : 'Chưa cập nhật' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ảnh đại diện:</strong></p>
                            @if (Auth::user()->image_profile)
                                <img src="{{ asset('storage/' . Auth::user()->image_profile) }}" alt="Avatar" width="120" class="rounded">
                            @else
                                <p>Chưa có ảnh</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

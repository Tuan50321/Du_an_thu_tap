@extends('admin.layouts.app')

@section('title', 'Sửa người dùng')

@section('content')
<div class="container mt-4">

    {{-- Thông báo --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <h5 class="mb-0 text-primary">✏️ Sửa người dùng</h5>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm" title="Quay lại danh sách">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                @method('PUT')

                {{-- Tên người dùng --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Tên người dùng</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mật khẩu (bỏ trống nếu không đổi) --}}
                <div class="col-md-6">
                    <label for="password" class="form-label">Mật khẩu mới (nếu đổi)</label>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Vai trò --}}
                <div class="col-md-6">
                    <label for="role" class="form-label">Vai trò</label>
                    <select name="role" id="role"
                            class="form-select @error('role') is-invalid @enderror">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Trạng thái --}}
                <div class="col-md-6">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select name="status" id="status"
                            class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Ngưng hoạt động</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nút lưu --}}
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Cập nhật người dùng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

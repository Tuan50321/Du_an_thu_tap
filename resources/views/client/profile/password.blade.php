@extends('client.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('client.profile.index') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-user"></i> Thông tin tài khoản
                </a>
                <a href="{{ route('client.profile.edit') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-edit"></i> Cập nhật thông tin
                </a>
                <a href="{{ route('client.profile.password') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-lock"></i> Đổi mật khẩu
                </a>
            </div>
        </div>

        <!-- Nội dung đổi mật khẩu -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Đổi mật khẩu</h4>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('client.profile.update-password') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

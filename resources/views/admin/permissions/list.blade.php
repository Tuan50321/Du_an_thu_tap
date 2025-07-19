@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý quyền</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                <i class="fas fa-shield-alt"></i> Phân quyền
            </a>
            <a href="{{ route('admin.permissions.trashed') }}" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Thùng rác
            </a>
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm quyền
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.permissions.list') }}" class="mb-4 d-flex gap-2 align-items-center">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control w-25"
               placeholder="Tìm quyền...">
        <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
        @if (request('search'))
            <a href="{{ route('admin.permissions.list') }}" class="btn btn-secondary">Xoá lọc</a>
        @endif
    </form>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên quyền</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description ?? 'Không có mô tả' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        
                                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-outline-primary btn-sm" title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc muốn xoá vai trò này?')" title="Xoá">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Không tìm thấy quyền nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $permissions->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection

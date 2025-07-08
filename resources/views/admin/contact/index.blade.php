@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản lý Liên hệ người dùng</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-4 d-flex gap-2 w-50">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control w-auto"
                placeholder="Tìm kiếm...">
            <button type="submit" class="btn btn-outline-primary">Tìm kiếm</button>
        </form>


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                                <th width="150px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ Str::limit($contact->message, 40) }}</td>
                                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xoá liên hệ này?')"
                                                title="Xoá">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Không có liên hệ nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

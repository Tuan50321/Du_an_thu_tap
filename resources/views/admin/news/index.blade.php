@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Quản lý Bài viết</h1>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm bài viết
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.news.index') }}" class="mb-4 d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control w-auto" placeholder="Tìm tiêu đề...">
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
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tác giả</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th width="200px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($news as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->news_id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category?->name ?? 'Không có' }}</td>
                                    <td>{{ $item->author?->name ?? 'Không rõ' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->status === 'published' ? 'success' : 'secondary' }}">
                                            {{ $item->status === 'published' ? 'Đã đăng' : 'Nháp' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->published_at ? $item->published_at->format('d/m/Y H:i') : 'Chưa đăng' }}</td>
                                    <td>
                                        <a href="{{ route('admin.news.show', $item) }}" class="btn btn-sm btn-info" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')"
                                                title="Xoá">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Không có bài viết nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

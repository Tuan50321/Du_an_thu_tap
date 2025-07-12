@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết danh mục</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $category->category_id }}</td>
                                </tr>
                                <tr>
                                    <th>Tên danh mục</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Danh mục cha</th>
                                    <td>{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td>{{ $category->description }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $category->status ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <div>
                            <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
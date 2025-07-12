@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết thương hiệu</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $brand->brand_id }}</td>
                                </tr>
                                <tr>
                                    <th>Tên thương hiệu</th>
                                    <td>{{ $brand->name }}</td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td>{{ $brand->description }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <span class="badge {{ $brand->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $brand->status === 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                        <div>
                            <a href="{{ route('admin.brands.edit', ['brand_id' => $brand->brand_id]) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.brands.destroy', ['brand_id' => $brand->brand_id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này không?')">
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
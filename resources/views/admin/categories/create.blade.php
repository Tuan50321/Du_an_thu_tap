@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới danh mục</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                <option value="">Không có danh mục cha</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ old('parent_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <div class="form-check">
                                <input type="checkbox" name="status" class="form-check-input" value="1" checked>
                                <label class="form-check-label">Kích hoạt</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu danh mục
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tạo sản phẩm mới</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="discount_price" class="form-label">Giá khuyến mãi</label>
                                    <input type="number" step="0.01" class="form-control @error('discount_price') is-invalid @enderror" 
                                        id="discount_price" name="discount_price" value="{{ old('discount_price') }}">
                                    @error('discount_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                        <option value="">Chọn trạng thái</option>
                                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                        <option value="">Chọn danh mục</option>
                                        @foreach($categories as $category)
                                            @if($category->status)
                                                <option value="{{ $category->category_id }}" 
                                                    {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select class="form-select @error('brand_id') is-invalid @enderror" 
                                        id="brand_id" name="brand_id" required>
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach($brands as $brand)
                                            @if($brand->status)
                                                <option value="{{ $brand->brand_id }}" 
                                                    {{ old('brand_id') == $brand->brand_id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Ảnh đại diện</label>
                                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                                        id="thumbnail" name="thumbnail" required>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gallery" class="form-label">Ảnh bổ sung</label>
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror" 
                                        id="gallery" name="gallery[]" multiple>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="stock">Số lượng tồn kho</label>
                                    <input type="number" class="form-control" id="stock" name="stock" required min="0" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
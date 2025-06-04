@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Banner</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.banners.update', $banner) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="image_url" class="form-label">Image URL</label>
                                <input type="text" class="form-control @error('image_url') is-invalid @enderror"
                                    id="image_url" name="image_url" value="{{ old('image_url', $banner->image_url) }}"
                                    required>
                                @error('image_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="link_url" class="form-label">Link URL (optional)</label>
                                <input type="text" class="form-control @error('link_url') is-invalid @enderror"
                                    id="link_url" name="link_url" value="{{ old('link_url', $banner->link_url) }}">
                                @error('link_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="number" class="form-control @error('position') is-invalid @enderror"
                                    id="position" name="position" value="{{ old('position', $banner->position) }}"
                                    required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="is_active" class="form-label">Status</label>
                                <select class="form-select @error('is_active') is-invalid @enderror" id="is_active"
                                    name="is_active" required>
                                    <option value="1"
                                        {{ old('is_active', $banner->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0"
                                        {{ old('is_active', $banner->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Banner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

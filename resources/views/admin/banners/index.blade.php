@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Banners</h1>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Banner
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Link URL</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <td>{{ $banner->banner_id }}</td>
                                <td>
                                    @if ($banner->image_url)
                                        <img src="{{ $banner->image_url }}" alt="Banner" style="max-width: 200px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if ($banner->link_url)
                                        <a href="{{ $banner->link_url }}" target="_blank">{{ $banner->link_url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $banner->position }}</td>
                                <td>
                                    <span class="badge bg-{{ $banner->is_active ? 'success' : 'secondary' }}">
                                        {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.banners.show', $banner) }}" class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this banner?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No banners found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

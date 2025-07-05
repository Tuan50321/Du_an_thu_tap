@extends('client.layouts.app')

@section('title', 'Tin tức - HOUSE HOLD GOOD')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-5 text-center fw-bold">Tin tức mới nhất</h2>
            <div class="row">
                <!-- Cột bài viết chính -->
                <div class="col-lg-8">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @forelse ($newsList as $news)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    @if ($news->image)
                                        <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}"
                                            style="height: 180px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold">{{ $news->title }}</h6>
                                        <p class="card-text small text-muted">
                                            {{ \Illuminate\Support\Str::limit($news->summary, 90) }}
                                        </p>

                                        {{-- ✅ Nút xem chi tiết --}}
                                        <a href="{{ route('client.news.show', ['news' => $news->news_id]) }}"
                                            class="btn btn-sm btn-outline-primary mt-2">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                    <div
                                        class="card-footer bg-white border-0 small text-muted d-flex justify-content-between">
                                        <span>Đăng bởi: <strong>{{ $news->author->name ?? 'Không rõ' }}</strong></span>
                                        <span>{{ optional($news->published_at)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Hiện chưa có bài viết nào.</div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Phân trang -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $newsList->links() }}
                    </div>
                </div>

                <!-- Cột danh mục + bài viết mới -->
                <div class="col-lg-4">

                    <!-- Danh mục -->
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-header bg-primary text-white py-3 rounded-top-4">
                            <h6 class="mb-0 fs-5">
                                <i class="fas fa-folder me-2"></i>Danh mục
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($categories as $cat)
                                <li class="list-group-item px-4 py-2">
                                    <a href="#" class="text-decoration-none text-dark d-block">
                                        <i class="fas fa-angle-right text-primary me-2"></i>{{ $cat->name }}
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted px-4 py-2">Không có danh mục</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Bài viết mới -->
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-secondary text-white py-3 rounded-top-4">
                            <h6 class="mb-0 fs-5">
                                <i class="fas fa-newspaper me-2"></i>Bài viết mới
                            </h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($latestNews as $item)
                                <li class="list-group-item px-4 py-2">
                                    <a href="{{ route('client.news.show', ['news' => $item->news_id]) }}"
                                        class="text-decoration-none text-dark d-block">
                                        <i class="fas fa-chevron-right me-2 text-success"></i>{{ $item->title }}
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted px-4 py-2">Không có bài viết mới</li>
                            @endforelse
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

@extends('client.layouts.app')

@section('title', $news->title . ' - HOUSE HOLD GOOD')

@section('content')
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <!-- Bài viết -->
                <div class="col-lg-8">
                    <h1 class="fw-bold mb-3">{{ $news->title }}</h1>

                    <div class="mb-3 text-muted small">
                        <i class="fas fa-user me-1"></i>{{ $news->author->name ?? 'Không rõ' }} |
                        <i class="fas fa-calendar-alt mx-1"></i>{{ optional($news->published_at)->format('d/m/Y') }} |
                        <i class="fas fa-folder mx-1"></i>{{ $news->category->name ?? 'Không phân loại' }}
                    </div>

                    @if ($news->image)
                        <div class="mb-4">
                            <img src="{{ asset($news->image) }}" class="img-fluid rounded w-100"
                                style="max-height: 450px; object-fit: cover;" alt="{{ $news->title }}">
                        </div>
                    @endif

                    <div class="mb-4 lead">
                        {{ $news->summary }}
                    </div>

                    <div class="content">
                        {!! $news->content !!}
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('client.news.index') }}" class="btn btn-outline-secondary">
                            ← Quay lại danh sách
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Danh mục -->
                    <div class="card mb-4 shadow-sm rounded-4 border-0 overflow-hidden">
                        <div class="card-header bg-primary text-white fw-semibold py-3 px-4 fs-5">
                            🗂 Danh mục bài viết
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($categories as $cat)
                                <li class="list-group-item px-4 py-2">
                                    <a href="#" class="text-decoration-none text-dark">
                                        <i class="fas fa-angle-right me-1 text-primary"></i> {{ $cat->name }}
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted px-4">Không có danh mục</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Bài viết mới -->
                    <div class="card mb-4 shadow-sm rounded-4 border-0 overflow-hidden">
                        <div class="card-header bg-secondary text-white fw-semibold py-3 px-4 fs-5">
                            📰 Bài viết mới
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse ($latestNews as $item)
                                <li class="list-group-item px-4 py-2">
                                    <a href="{{ route('client.news.show', ['news' => $item->news_id]) }}"
                                        class="text-decoration-none text-dark d-block">
                                        <i class="fas fa-newspaper me-1 text-success"></i> {{ $item->title }}
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item text-muted px-4">Không có bài viết mới</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Bình luận -->
                    <div class="comments-section mt-5">
                        <h4 class="fw-bold mb-4 border-bottom pb-2">
                            💬 Bình luận ({{ $news->comments->count() }})
                        </h4>

                        <!-- Danh sách bình luận -->
                        @forelse ($news->comments as $comment)
                            <div class="mb-4 ps-3 border-start border-3 border-primary">
                                <div class="fw-semibold text-primary">
                                    {{ $comment->user->name ?? 'Khách' }}
                                </div>
                                <div class="text-muted small">
                                    {{ $comment->created_at->format('d/m/Y H:i') }}
                                </div>
                                <p class="mt-2 mb-0">{{ $comment->content }}</p>
                            </div>
                        @empty
                            <p class="text-muted fst-italic">Chưa có bình luận nào.</p>
                        @endforelse

                        <div class="mt-5">
                            <h5 class="mb-3">✍️ Gửi bình luận của bạn</h5>

                            @auth
                                <form action="{{ route('client.news.comment', $news->news_id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control" rows="3" required placeholder="Nội dung bình luận...">{{ old('content') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Gửi bình luận
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-warning">
                                    Vui lòng <a href="{{ route('login') }}" class="text-primary fw-bold">đăng nhập</a> để gửi
                                    bình luận.
                                </div>
                            @endauth
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

<?php

namespace App\Http\Controllers\Client\Baiviet;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $newsList = News::where('status', 'published')
            ->latest('published_at')
            ->paginate(10);

        $categories = NewsCategory::all();
        $latestNews = News::where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('client.Baiviet.index', compact('newsList', 'categories', 'latestNews'));
    }

    public function show($news_id)
    {
        $news = \App\Models\News::where('news_id', $news_id)->firstOrFail();

        if ($news->status !== 'published') {
            abort(404);
        }

        $categories = NewsCategory::all();
        $latestNews = News::where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('client.Baiviet.show', compact('news', 'categories', 'latestNews'));
    }

    public function comment(Request $request, $news_id)
    {
        $news = \App\Models\News::where('news_id', $news_id)->firstOrFail();

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        NewsComment::create([
            'news_id' => $news->id,
            'user_id' => Auth::id(), // hoặc null nếu cho phép ẩn danh
            'content' => $request->input('content'),
            'is_hidden' => false, // có thể dùng để duyệt thủ công
        ]);

        return back()->with('success', 'Bạn đã bình luận cho bài viết thành công.');
    }
}

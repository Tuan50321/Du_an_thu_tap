<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'product']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $reviews = $query->latest()->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::with(['user', 'product'])->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }


    public function toggleVisibility($id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = !$review->is_approved;
        $review->save();

        return redirect()->back()->with('success', 'Đã cập nhật trạng thái hiển thị đánh giá.');
    }
}

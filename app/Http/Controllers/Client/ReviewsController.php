<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        $data['user_id'] = auth()->id();
        $data['is_approved'] = 1; // Mặc định là hiển thị ngay
        // Mặc định đánh giá được hiển thị

        Review::create($data);

        return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá!');
    }
}

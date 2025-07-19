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
            'product_id' => 'required|exists:products,product_id', // đúng tên cột trong DB
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        // $data['user_id'] = auth()->id();

        Review::create($data); // Laravel sẽ tự thêm created_at, updated_at

        return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá!');
    }
}

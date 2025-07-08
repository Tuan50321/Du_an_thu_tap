<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orderCount = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::sum('total_amount');
        $productCount = \App\Models\Product::count();
        $userCount = \App\Models\User::count(); // Tổng khách hàng
        $newsCount = \App\Models\News::count();
        $totalUsers = \App\Models\User::count(); // Tổng người dùng (bao gồm cả admin nếu có)
        // Sản phẩm bán chạy nhất (dựa vào tổng số lượng bán trong order_items)
        $bestSellers = \App\Models\Product::select('products.*')
            ->join('product_variants', 'products.product_id', '=', 'product_variants.product_id')
            ->join('order_items', 'product_variants.variant_id', '=', 'order_items.variant_id')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->groupBy('products.product_id')
            ->orderByDesc('total_sold')
            ->limit(4)
            ->get();
        // 4 sản phẩm mới nhất
        $latestProducts = \App\Models\Product::orderByDesc('created_at')->limit(4)->get();
        return view('admin.dashboard', compact('orderCount', 'totalRevenue', 'productCount', 'userCount', 'newsCount', 'totalUsers', 'bestSellers', 'latestProducts'));
    }
} 
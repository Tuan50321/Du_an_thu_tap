<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['category', 'brand'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $categories = Category::withCount('products')->get();
        $brands = Brand::all();
        $banners = Banner::where('is_active', 1)->whereNotNull('image_url')->get();
        $latestNews = News::where('status', 'published')
            ->orderBy('published_at', 'desc')   // <-- SỬA Ở ĐÂY
            ->take(3)
            ->get();

        return view('client.home', compact('featuredProducts', 'categories', 'brands', 'banners', 'latestNews'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $products = Product::with(['category', 'brand'])
            ->where('status', 'active')
            ->where('name', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::withCount('products')->get();
        $brands = Brand::all();
        $banners = Banner::where('is_active', 1)->whereNotNull('image_url')->get();
        $latestNews = News::where('status', 'published')
            ->orderBy('published_at', 'desc')   // <-- SỬA Ở ĐÂY
            ->take(3)
            ->get();

        return view('client.home', compact('products', 'categories', 'brands', 'banners', 'latestNews', 'query'));
    }
}

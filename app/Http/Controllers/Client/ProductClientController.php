<?php

namespace App\Http\Controllers\Client;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductClientController extends Controller
{
public function index(Request $request)
{
    $query = Product::with(['category', 'brand'])
        ->where('status', 'active');

    // 1. Lọc theo danh mục
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 2. Lọc theo thương hiệu
    if ($request->filled('brand_id')) {
        $query->where('brand_id', $request->brand_id);
    }

    // 3. LỌC THEO KHOẢNG GIÁ (NÂNG CẤP)
    if ($request->filled('min_price') && $request->filled('max_price')) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    // 4. Sắp xếp
    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
                $query->latest();
                break;
        }
    } else {
        $query->latest();
    }

    $products = $query->paginate(12)->withQueryString();
    $categories = Category::withCount('products')->where('status', 1)->get();
    $brands = Brand::withCount('products')->get();

    if ($request->ajax()) {
        return view('client.products.partials.product_list', compact('products'))->render();
    }

    return view('client.products.index', compact('products', 'categories', 'brands'));
}

    public function show($id)
{


    return view('client.show');
}

}

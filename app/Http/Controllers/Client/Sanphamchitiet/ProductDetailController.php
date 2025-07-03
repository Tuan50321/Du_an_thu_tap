<?php

namespace App\Http\Controllers\Client\Sanphamchitiet;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        // Lấy sản phẩm
        $product = Product::with(['brand', 'category', 'creator'])->findOrFail($id);

        // Lấy tất cả biến thể của sản phẩm
        $variants = ProductVariant::where('product_id', $product->product_id)->get();

        // Lấy danh sách giá trị duy nhất của từng thuộc tính
        $rams = $variants->pluck('ram')->unique()->filter()->values();
        $roms = $variants->pluck('rom')->unique()->filter()->values();
        $colors = $variants->pluck('color')->unique()->filter()->values();
        $materials = $variants->pluck('material')->unique()->filter()->values();

        // Sản phẩm liên quan
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->take(4)
            ->get();

        return view('client.product-details.index', compact(
            'product', 'variants', 'rams', 'roms', 'colors', 'materials', 'relatedProducts'
        ));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo truy vấn lấy các sản phẩm đang hoạt động và thuộc danh mục đang hoạt động


        // Trả về view với dữ liệu sản phẩm
        return view('client.home');
    }

    public function show($id)
{


    return view('client.show');
}

}

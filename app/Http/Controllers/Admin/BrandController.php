<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:brands',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Brand::create($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Thương hiệu đã được tạo thành công');
    }

    public function show($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        return view('admin.brands.show', compact('brand'));
    }

    public function edit($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $brand_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:brands,name,' . $brand_id . ',brand_id',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $brand = Brand::findOrFail($brand_id);
        $brand->update($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Thương hiệu đã được cập nhật thành công');
    }

    public function destroy($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();
        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully');
    }
} 
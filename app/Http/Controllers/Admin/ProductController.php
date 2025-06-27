<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand', 'creator'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'brand_id' => 'required|exists:brands,brand_id',
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value >= $request->price) {
                        $fail('The discount price must be less than the original price.');
                    }
                }
            ],
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'discount_price.numeric' => 'The discount price must be a number.',
            'discount_price.min' => 'The discount price must be at least 0.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2MB.'
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => Auth::id()
        ]);

        // Upload thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            $product->uploadThumbnail($request->file('thumbnail'));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'creator']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'brand_id' => 'required|exists:brands,brand_id',
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value >= $request->price) {
                        $fail('The discount price must be less than the original price.');
                    }
                }
            ],
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'discount_price.numeric' => 'The discount price must be a number.',
            'discount_price.min' => 'The discount price must be at least 0.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2MB.'
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            'status' => $request->status
        ]);

        // Upload thumbnail mới nếu có
        if ($request->hasFile('thumbnail')) {
            $product->uploadThumbnail($request->file('thumbnail'));
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
} 
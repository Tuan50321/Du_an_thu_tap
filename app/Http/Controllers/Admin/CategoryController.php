<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->paginate(50);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Category([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->has('status')
        ]);

        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        // Load parent and children relationships
        $category->load(['parent', 'children']);
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::where('category_id', '!=', $category->category_id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->status = $request->has('status');
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
} 
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $request->validate(['category_name' => 'required|max:255']);
        Category::create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'status' => $request->status ?? 1,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Đã thêm danh mục!');
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate(['category_name' => 'required|max:255']);
        $category->update([
            'category_name' => $request->category_name,
            'status' => $request->status ?? 1,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Đã cập nhật!');
    }

    public function destroy(Category $category) {
        $category->delete();
        return back()->with('success', 'Đã xóa danh mục!');
    }
}
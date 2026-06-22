<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller {
    public function index() {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::where('status', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'product_name'   => 'required|max:255',
            'category_id'    => 'required|exists:categories,id',
            'base_price'     => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'thumbnail'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('products/thumbnails', 'public')
            : null;

        $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'slug' => Str::slug($request->product_name) . '-' . uniqid(),
            'thumbnail' => $thumbnailPath,
            'base_price' => $request->base_price,
            'sale_price' => $request->sale_price,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products/gallery', 'public');
                ProductImage::create(['product_id' => $product->id, 'image_path' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $product) {
        $categories = Category::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'product_name' => 'required|max:255',
            'base_price'   => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('thumbnail')) {
            $product->thumbnail = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'base_price' => $request->base_price,
            'sale_price' => $request->sale_price,
            'stock_quantity' => $request->stock_quantity,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return back()->with('success', 'Đã xóa sản phẩm!');
    }
}
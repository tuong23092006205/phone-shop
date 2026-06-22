<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller {
    public function category($slug) {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Product::with(['category', 'images'])
            ->where('category_id', $category->id)
            ->where('status', 1);

        if (request('min_price')) $query->where('base_price', '>=', request('min_price'));
        if (request('max_price')) $query->where('base_price', '<=', request('max_price'));
        if (request('q')) $query->where('product_name', 'LIKE', '%' . request('q') . '%');

        $sort = request('sort', 'latest');
        match($sort) {
            'price_asc'  => $query->orderBy('base_price', 'asc'),
            'price_desc' => $query->orderBy('base_price', 'desc'),
            default      => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('status', 1)->get();

        return view('frontend.category', compact('category', 'products', 'categories'));
    }

    public function show($slug) {
        $product = Product::with(['category', 'images'])
            ->where('slug', $slug)->where('status', 1)->firstOrFail();

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)->take(4)->get();

        return view('frontend.product-detail', compact('product', 'related'));
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller {
    public function index() {
        $categories = Category::where('status', 1)->get();

        $featuredPhones = Product::with('category')
            ->whereHas('category', fn($q) => $q->where('slug', 'dien-thoai'))
            ->where('status', 1)->latest()->take(8)->get();

        $featuredLaptops = Product::with('category')
            ->whereHas('category', fn($q) => $q->where('slug', 'may-tinh'))
            ->where('status', 1)->latest()->take(8)->get();

        return view('frontend.home', compact('categories', 'featuredPhones', 'featuredLaptops'));
    }

    public function search() {
        $keyword = request('q');
        $products = Product::with('category')
            ->where('status', 1)
            ->where('product_name', 'LIKE', "%{$keyword}%")
            ->paginate(12);

        return view('frontend.search', compact('products', 'keyword'));
    }
}
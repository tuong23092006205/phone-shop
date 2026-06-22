<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function index() {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request) {
        $product = Product::findOrFail($request->product_id);
        if ($product->stock_quantity < 1) {
            return response()->json(['error' => 'Sản phẩm đã hết hàng!'], 400);
        }

        $cart = session()->get('cart', []);
        $qty  = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id, 'name' => $product->product_name,
                'price' => $product->sale_price ?? $product->base_price,
                'image' => $product->thumbnail, 'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);
        return response()->json([
            'success' => 'Đã thêm vào giỏ hàng!',
            'cart_count' => collect($cart)->sum('quantity'),
        ]);
    }

    public function update(Request $request) {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return response()->json(['success' => true, 'total' => number_format($total, 0, ',', '.')]);
    }

    public function remove(Request $request) {
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);
        return response()->json(['success' => 'Đã xóa sản phẩm!']);
    }
}
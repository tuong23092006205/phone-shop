<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }
        return view('frontend.checkout', compact('cart'));
    }

    public function store(Request $request) {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:15',
            'shipping_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),  
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'total_amount' => $total,
                'payment_method' => 'COD',
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id, 'product_id' => $item['id'],
                    'quantity' => $item['quantity'], 'price' => $item['price'],
                ]);
                Product::where('id', $item['id'])->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Đặt hàng thành công! Mã đơn: #' . $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
}
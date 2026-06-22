<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller {
    public function myOrders() {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('frontend.my-orders', compact('orders'));
    }

    public function show($id) {
        $order = Order::with('orderDetails.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('frontend.order-detail', compact('order'));
    }
}
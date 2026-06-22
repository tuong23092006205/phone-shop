<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller {
    public function index() {
        $totalOrders   = Order::count();
        $totalRevenue  = Order::where('status', 'completed')->sum('total_amount');
        $totalProducts = Product::count();
        $totalUsers    = User::where('role', 'customer')->count();
        $recentOrders  = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalProducts', 'totalUsers', 'recentOrders'
        ));
    }
}
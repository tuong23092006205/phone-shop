<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/danh-muc/{slug}', [ProductController::class, 'category'])->name('category.show');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/them', [CartController::class, 'add'])->name('cart.add');
Route::post('/gio-hang/cap-nhat', [CartController::class, 'update'])->name('cart.update');
Route::post('/gio-hang/xoa', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/thanh-toan', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/don-hang/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/tai-khoan/don-hang', [OrderController::class, 'myOrders'])->name('orders.index');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('products', Admin\ProductController::class);
    Route::resource('orders', Admin\OrderController::class)->only(['index', 'show', 'update']);
    Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
});
<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create([
            'name' => 'Admin', 'email' => 'admin@phoneshop.com',
            'password' => Hash::make('password123'), 'role' => 'admin',
        ]);

        User::create([
            'name' => 'Nguyễn Văn A', 'email' => 'customer@test.com',
            'password' => Hash::make('password123'), 'role' => 'customer',
        ]);

        $phone  = Category::create(['category_name' => 'Điện thoại', 'slug' => 'dien-thoai', 'status' => 1]);
        $laptop = Category::create(['category_name' => 'Máy tính', 'slug' => 'may-tinh', 'status' => 1]);
        Category::create(['category_name' => 'Phụ kiện', 'slug' => 'phu-kien', 'status' => 1]);

        $phones = [
            ['iPhone 15 Pro Max 256GB', 34990000, 32990000],
            ['Samsung Galaxy S24 Ultra', 31990000, 29990000],
            ['OPPO Find X7 Ultra', 22990000, null],
            ['Xiaomi 14 Pro', 18990000, 17490000],
        ];
        foreach ($phones as [$name, $base, $sale]) {
            Product::create([
                'category_id' => $phone->id, 'product_name' => $name,
                'slug' => Str::slug($name) . '-' . uniqid(),
                'base_price' => $base, 'sale_price' => $sale,
                'stock_quantity' => rand(10, 50), 'status' => 1,
            ]);
        }

        $laptops = [
            ['MacBook Pro M3 14 inch', 49990000, 47990000],
            ['Dell XPS 15 9530', 42990000, null],
            ['ASUS ROG Zephyrus G14', 38990000, 36990000],
            ['Lenovo ThinkPad X1 Carbon', 35990000, null],
        ];
        foreach ($laptops as [$name, $base, $sale]) {
            Product::create([
                'category_id' => $laptop->id, 'product_name' => $name,
                'slug' => Str::slug($name) . '-' . uniqid(),
                'base_price' => $base, 'sale_price' => $sale,
                'stock_quantity' => rand(5, 20), 'status' => 1,
            ]);
        }
    }
}
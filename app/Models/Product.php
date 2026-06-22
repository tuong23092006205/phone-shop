<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model {
    protected $fillable = [
        'category_id', 'product_name', 'slug', 'thumbnail',
        'base_price', 'sale_price', 'stock_quantity', 'description', 'status'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->product_name) . '-' . uniqid();
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function getDisplayPriceAttribute() {
        return $this->sale_price ?? $this->base_price;
    }
}
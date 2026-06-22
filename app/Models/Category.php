<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model {
    protected $fillable = ['category_name', 'slug', 'status'];

    protected static function boot() {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = Str::slug($category->category_name);
        });
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
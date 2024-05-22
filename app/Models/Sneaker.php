<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'brand_id', 'color_code', 'image_path', 'size', 'stock', 'category_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // public function sizes()
    // {
    //     return $this->hasMany(Size::class);
    // }

    // public function colors()
    // {
    //     return $this->hasMany(Color::class);
    // }

    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }

    // public function cartItems()
    // {
    //     return $this->hasMany(CartItem::class);
    // }

    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

    // public function featuredProducts()
    // {
    //     return $this->hasMany(FeaturedProduct::class);
    // }
}

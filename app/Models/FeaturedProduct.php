<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProduct extends Model
{
    use HasFactory;

    protected $fillable = ['order', 'sneaker_id'];

    /**
     * Get the sneaker associated with the featured product.
     */
    public function sneaker()
    {
        return $this->belongsTo(Sneaker::class);
    }

    /**
     * Get the category associated with the featured product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

 
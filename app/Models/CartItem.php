<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id','sneaker_id','quantity',];

    /**
     * Get the sneaker associated with the item.
     */
    public function sneaker()
    {
        return $this->belongsTo(Sneaker::class);
    }
}


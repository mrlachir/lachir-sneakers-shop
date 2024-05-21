<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'sneaker_id', 'quantity', 'price'];

    // Define the relationship with Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with Sneaker model
    public function sneaker()
    {
        return $this->belongsTo(Sneaker::class);
    }
}

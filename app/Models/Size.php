<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['sneaker_id', 'size', 'stock'];

    // Define the relationship with Sneaker model
    public function sneaker()
{
    return $this->belongsTo(Sneaker::class);
}
}

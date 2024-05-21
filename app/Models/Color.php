<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['color', 'stock'];

    // Define the relationship with Sneaker model
    public function sneaker()
{
    return $this->belongsTo(Sneaker::class);
}
}

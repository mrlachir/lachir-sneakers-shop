<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['sneaker_id', 'quantity'];

    /**
     * Get the sneaker associated with the cart item.
     */
    public function sneaker()
    {
        return $this->belongsTo(Sneaker::class);
    }
    public static function count()
    {
        return static::sum('quantity');
    }
}

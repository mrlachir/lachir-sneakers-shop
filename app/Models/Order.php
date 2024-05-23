<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'sneaker_id', 'quantity', 'total_price'];

    public function sneaker()
    {
        return $this->belongsTo(Sneaker::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


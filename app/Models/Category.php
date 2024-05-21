<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_path'];

    // Define any relationships here if needed
    public function sneakers()
    {
        return $this->hasMany(Sneaker::class);
    }
}

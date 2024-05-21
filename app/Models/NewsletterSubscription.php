<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscription extends Model
{
    protected $fillable = ['email'];

    // No direct relationships with other models
    public function user()
{
    return $this->belongsTo(User::class);
}
}

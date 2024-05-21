<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // protected $fillable = ['user_id', 'order_id', 'message'];
    protected $fillable = [
        'notifiable_id', 'notifiable_type', 'data', 'read_at',
     ];

    // Define the relationship with User model
    public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function order()
   {
       return $this->belongsTo(Order::class);
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dish_id',
        'quantity',
        'distance_km',
        'total_price',
        'estimated_time_min',
        'status',
    ];
    

    // 🧍 Har bir buyurtma bitta foydalanuvchiga tegishli
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🍲 Har bir buyurtma bitta taomga tegishli
    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}

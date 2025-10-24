<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class OrderItem extends Model
{
    use HasFactory ,Notifiable;

    protected $fillable =[
        'order_id',
        'dish_id',
        'quantity',
        'subtotal'
    ];
        public function order(){
        return $this->belongsTo(Order::class);
    }

        public function dish(){
        return $this->belongsTo(Dish::class);
    }
}


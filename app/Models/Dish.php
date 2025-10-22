<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'imoge',
        'created_by',
    ];
    
    
    protected $casts =[
        'email_verified_at' => 'datatime',
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
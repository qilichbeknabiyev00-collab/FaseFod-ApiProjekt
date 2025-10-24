<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Dish;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $dish = Dish::first();

        if (!$user || !$dish) {
            $this->command->warn('⚠️ User yoki Dish topilmadi. Avval UserSeeder va DishSeeder ni ishga tushiring.');
            return;
        }

        $orders = [
            [
                'user_id' => $user->id,
                'dish_id' => $dish->id,
                'quantity' => 2,
                'distance_km' => 0.45,
                'total_price' => $dish->price * 2,
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'dish_id' => $dish->id,
                'quantity' => 1,
                'distance_km' => 0.60,
                'total_price' => $dish->price * 1,
                'status' => 'accepted',
            ],
            [
                'user_id' => $user->id,
                'dish_id' => $dish->id,
                'quantity' => 3,
                'distance_km' => 0.75,
                'total_price' => $dish->price * 3,
                'status' => 'delivered',
            ],
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }

        $this->command->info('✅ Orders jadvaliga namunaviy buyurtmalar qo‘shildi.');
    }
}

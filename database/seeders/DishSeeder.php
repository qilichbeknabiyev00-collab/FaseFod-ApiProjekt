<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
   
    public function run(): void
    {
        Dish::insert([
           [
            'name' => 'Burger',
            'description' => 'Mazali go‘shtli burger',
            'price' => 25000,
            'created_by' => 1, // masalan waiter
        ],
        [
            'name' => 'Pizza',
            'description' => 'Pishloqli pizza',
            'price' => 40000,
            'created_by' => 1,
        ],
        
    ]);
    }
}

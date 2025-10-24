<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;     

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        
            $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DishSeeder::class,
            OrderSeeder::class
            ]);
        
            User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

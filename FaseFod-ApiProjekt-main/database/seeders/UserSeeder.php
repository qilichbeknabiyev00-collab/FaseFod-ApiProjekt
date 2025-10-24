<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    public function run(): void
    {
     
        User::insert([
        [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ],
        [
            'name' => 'Waiter User',
            'email' => 'waiter@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ],
        [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ],
        ]);
                
    }
}
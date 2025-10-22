<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
   
    public function run(): void
    {
        Role::insert([
            ['name'=>'Admin'],
            ['name'=>'Waiter'],
            ['name'=>'User']
        ]);
    }
}

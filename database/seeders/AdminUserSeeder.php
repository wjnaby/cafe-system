<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@cafe.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create test customer
        User::create([
            'name' => 'Customer',
            'email' => 'customer@cafe.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
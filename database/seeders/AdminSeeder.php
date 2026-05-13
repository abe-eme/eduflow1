<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // change if needed
            [
                'name' => 'System Admin',
                'password' => Hash::make('admin123'), // change password if you want
                'role' => 'admin',
                'status' => 'active'
            ]
        );
    }
}
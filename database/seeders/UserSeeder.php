<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

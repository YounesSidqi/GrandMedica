<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Moderator',
                'email' => 'moderator@gmail.com',
                'role' => 'MODERATOR',
                'password' => Hash::make('MODERATOR2025')
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'ADMIN',
                'password' => Hash::make('ADMIN2025')
            ],
            [
                'name' => 'Users',
                'email' => 'users@gmail.com',
                'role' => 'USERS',
                'password' => Hash::make('USERS2025')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

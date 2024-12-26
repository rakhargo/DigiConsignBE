<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rakha Dhifiargo',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'), // Pastikan untuk mengenkripsi password
        ]);

        User::create([
            'name' => 'Yusdan Ali',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Furqon Hilmy',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => \bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => \bcrypt('password'),
            'role' => 'user'
        ]);
    }
}

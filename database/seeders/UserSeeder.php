<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Hotel',
            'email' => 'admin@hotel.com',
            'password' => bcrypt('password'),
            'role' => 'admin', // Mengatur sebagai Admin [cite: 38]
            'phone' => '08123456789'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'position' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0925728232',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}

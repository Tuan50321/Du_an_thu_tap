<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin'),
            'role' => 'admin', // Set role for admin user
        ]);

        User::create([
            'name' => 'user',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('user'),
            'role' => 'user', // Set role for regular user
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'       => 'Admin',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('123456789@'),
            'role'       => 'admin',
            'is_active'  => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::create([
            'name'       => 'User',
            'email'      => 'user@gmail.com',
            'password'   => Hash::make('123456789'),
            'role'       => 'user',
            'is_active'  => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

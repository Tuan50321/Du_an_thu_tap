<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_roles')->insert([
            [
                'user_id'       => 1,
                'permission_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 1,
                'permission_id' => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 2,
                'permission_id' => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 3,
                'permission_id' => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}

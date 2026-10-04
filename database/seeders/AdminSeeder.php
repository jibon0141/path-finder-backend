<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Test Admin',
                'password' => Hash::make('12345678'),
                'mobile_number' => '01832265649',
                'picture' => 'picture/admin_picture/1733574632_about.jpg',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}

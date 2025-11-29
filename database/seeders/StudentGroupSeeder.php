<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\StudentGroup::create([
            'group_name' => 'Science',
            'description' => 'Science group with Physics, Chemistry, Biology',
            'status' => 1
        ]);
        
        \App\Models\StudentGroup::create([
            'group_name' => 'Arts',
            'description' => 'Arts group with History, Geography, Civics',
            'status' => 1
        ]);
        
        \App\Models\StudentGroup::create([
            'group_name' => 'Commerce',
            'description' => 'Commerce group with Accounting, Business Studies, Economics',
            'status' => 1
        ]);
    }
}

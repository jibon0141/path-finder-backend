<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Student::create([
            'student_name' => 'Rafiq Ahmed',
            'age' => 20,
            'student_email' => 'rafiq.ahmed1@gmail.com',
            'student_group_id' => 1
        ]);

        \App\Models\Student::create([
            'student_name' => 'Tania Rahman',
            'age' => 21,
            'student_email' => 'tania.rahman2@gmail.com',
            'student_group_id' => 1
        ]);

        \App\Models\Student::create([
            'student_name' => 'Arifur Rahman',
            'age' => 21,
            'student_email' => 'arifur.rahman11@gmail.com',
            'student_group_id' => 2
        ]);

        \App\Models\Student::create([
            'student_name' => 'Taslima Khan',
            'age' => 20,
            'student_email' => 'taslima.khan21@gmail.com',
            'student_group_id' => 3
        ]);
    }
}

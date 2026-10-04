<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Science (Group 1)
            ['subject_name' => 'Physics', 'group_id' => 1],
            ['subject_name' => 'Chemistry', 'group_id' => 1],
            ['subject_name' => 'Biology', 'group_id' => 1],
            ['subject_name' => 'Higher Mathematics', 'group_id' => 1],

            // Arts (Group 2)
            ['subject_name' => 'History', 'group_id' => 2],
            ['subject_name' => 'Geography', 'group_id' => 2],
            ['subject_name' => 'Civics', 'group_id' => 2],
            ['subject_name' => 'Economics', 'group_id' => 2],

            // Commerce (Group 3)
            ['subject_name' => 'Accounting', 'group_id' => 3],
            ['subject_name' => 'Business Studies', 'group_id' => 3],
            ['subject_name' => 'Finance & Banking', 'group_id' => 3],
        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->updateOrInsert(
                [
                    'subject_name' => $subject['subject_name'],
                    'group_id' => $subject['group_id'],
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

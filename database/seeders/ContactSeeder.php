<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Contact::create([
            'student_id' => 1,
            'phone' => '+1234567890',
            'address' => '123 Main St',
            'city' => 'New York',
            'country' => 'USA'
        ]);

        \App\Models\Contact::create([
            'student_id' => 2,
            'phone' => '+0987654321',
            'address' => '456 Oak Ave',
            'city' => 'Los Angeles',
            'country' => 'USA'
        ]);

        \App\Models\Contact::create([
            'student_id' => 3,
            'phone' => '+1122334455',
            'address' => '789 Pine Rd',
            'city' => 'Chicago',
            'country' => 'USA'
        ]);
    }
}

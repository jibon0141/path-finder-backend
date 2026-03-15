<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Account::create([
            'account_no' => 'ACC-001',
            'account_name' => 'Cash Account',
            'branch_name' => 'Head Office',
            'opening_balance' => 0.00,
            'balance' => 0.00,
            'status' => true,
            'is_default' => true,
        ]);
        
        \App\Models\Account::create([
            'account_no' => 'ACC-002',
            'account_name' => 'Bank Account',
            'branch_name' => 'City Branch',
            'opening_balance' => 10000.00,
            'balance' => 10000.00,
            'status' => true,
            'is_default' => false,
        ]);
    }
}

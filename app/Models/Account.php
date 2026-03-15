<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_no',
        'account_name',
        'branch_name',
        'opening_balance',
        'balance',
        'status',
        'is_default',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'balance' => 'decimal:2',
        'status' => 'boolean',
        'is_default' => 'boolean',
    ];
}

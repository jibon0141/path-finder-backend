<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tests';

    protected $fillable = [
        'name',
        'age',
        'image',
        'email',
        'phone',
        'status',
        'description',
    ];

    protected $casts = [
        'age' => 'integer',
        'status' => 'boolean',
    ];
}

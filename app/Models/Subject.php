<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    protected $table = 'subjects';


    protected $fillable = [
        'subject_name',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(StudentGroup::class, 'group_id');
    }
}

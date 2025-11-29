<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class StudentGroup extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'description', 'status'];

    // public function students()
    // {
    //     return $this->hasMany(Student::class);
    // }

    public function student()
    {
        return $this->hasMany(Student::class,'student_group_id','id');
    }
    
}

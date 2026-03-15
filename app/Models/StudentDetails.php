<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    use HasFactory;

    protected $table = 'student_details';

    protected $fillable = [
        'student_id',
        'father_name',
        'mother_name',
        'nationality',
        'date_of_birth',
        'gender',
        'religion',
        'blood_group',
        'address',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }



}

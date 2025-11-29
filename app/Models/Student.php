<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    
    protected $fillable = [
        'student_name',
        'age',
        'student_email',
        'student_group_id'
    ];



    public function contact()
    {
        return $this->hasOne(Contact::class, 'student_id', 'id');
    }


    public function studentGroup()
    {
        return $this->belongsTo(StudentGroup::class, 'student_group_id', 'id');
    }


   
}

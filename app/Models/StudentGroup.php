<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Rap2hpoutre\FastExcel\FastExcel;

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

    public function findByFilters($search=[],$type='first'){
        $query=self::query();
        if(!empty($search['id'])){
            $query->where('id',$search['id']);
        }

        $query= $query->$type();
        return $query;
        
    }
    
}




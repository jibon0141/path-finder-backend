<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Contact;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Support\Facades\DB;

class StudentContactCronJob extends Command{

    protected $signature='process:student_details';
    protected $details='Export All Student Details To Fast Excell'; 

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        $data=Student::with('contact')->get();
        $data1=Student::with('studentGroup')->get();
        $data2=DB::table('students')
        ->rightjoin('contacts','contacts.student_id','=','students.id')
         ->select('students.id', 'students.student_name', 'contacts.phone', 'contacts.address')
        ->get();
        dd($data2);
    //  dd($data->toArray(),$data1->toArray());


    }

}
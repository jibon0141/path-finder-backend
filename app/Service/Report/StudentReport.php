<?php
namespace App\Service\Report;
use App\Models\Student;
use App\Models\Contact;
use App\Models\StudentGroup;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentReport{

    public $studentGroupCollection;
    

    public function getHeader(){
        $commonHeader=
        [
        'student_name'=>'Student Name',
        'student_id'=>'Student Roll',
        'term'=>'Term',
        'group'=>'Group'
        ];

        return $commonHeader;
    }


    public function generateReport($search){
      
       $this->setStudentGroupCollection();
        $prepareData=$this->prepareData();
        // $data=array_merge($this->getHeader(), $prepareData);
      
       $filePath = storage_path('app/exports/studentReport.csv');
      (new FastExcel(collect($prepareData)))->export($filePath);

     \Log::info('Student Report exported successfully to Excel', ['path' => $filePath]);
      
       
   if(!empty( $search['is_email_send'])){
           try{   
    $to_email='jibon0141@gmail.com';
   $to_name='Abid Hasan';
 $data = array('verify_code' => 12345);

   Mail::send('emails.admin.email_template.verify_mail', $data, function($message) use ($to_name, $to_email) {
   $message->to($to_email, $to_name)
   ->subject('Verification Code');
   $message->from('info@traveloguebd.com','Traveloguebd');
   });
   
   }
   catch(\Exception $e){
    dd($e);
   }
   }
 
       
    }

    public function prepareData(){
        $studentCollectionArray=[];

        $studentCollection=(new Student)->getData();
        if($studentCollection->isNotEmpty()){
            foreach($studentCollection as $student){
                $studentCollectionArray[]=$this->prepareRows($student);
            }
        }
        // dd($studentCollectionArray);
        return $studentCollectionArray;

    }

    public function prepareRows($student){

        $prepareRow=[];

        $prepareRow["student_name"]=$student->student_name;
        $prepareRow["student_id"]=$student->id;
        $prepareRow["term"]="1st Term";
        $prepareRow["group"]=$this->getStudentGroupById($student->student_group_id)->group_name ?? '';
        // $prepareRow["group"]=StudentGroup::where('id',$student->student_group_id)->first()->group_name ?? '';

        return $prepareRow;

    }

    public function setStudentGroupCollection(){
         $this->studentGroupCollection=(new StudentGroup)->findByFilters([],'get');
    }

    public function getStudentGroupById($id){
        return $this->studentGroupCollection->where('id',$id)->first();
    }




}
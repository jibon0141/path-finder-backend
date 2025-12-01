<?php
namespace App\Http\Controllers\Backend\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\HandelErrorSuccess;
use App\Traits\ManageImage;
use App\Models\Student;

class StudentController extends Controller{

    use HandelErrorSuccess,ManageImage;
    
    public function storeStudent(Request $request){

        $request->validate([
            'student_name'=>'required',
            'age'=>'required',
            'student_image'=>'required',
            'student_email' => 'required|email|unique:students,student_email',
            'student_group_id'=>'required',
        ]);

        try{
            DB::beginTransaction();

            if(!$request->hasFile('student_image')){
                Log::error('Image is Not properly passed through request!');
            }
            $imageName=storeImage($request->file('student_image'),'picture/student_image');

            if($request->isMethod('POST')){
                 $data=[
                     'student_name'=>$request->student_name,
                     'age'=>$request->age,
                     'student_image'=> $imageName,
                     'student_email'=>$request->student_email,
                     'student_group_id'=>$request->student_group_id,
                     'created_at'=>now (),
                 ];

                 DB::table('students')->insert($data);
                 DB::commit();
                 Log::info('Student Successfully Stored!');
                 return $this->success('Student Successfully Stored!');
            }

            return view();

        }
        catch(\Illuminate\Validation\ValidationException $e){
            DB::rollBack();
            Log::error('Validation Error!');
            return $this->validationError($e, 'Please provide valid input.');

        }
        catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->genericError($e,'Student Store Unsuccessful!');
        }

    }

    public function showStudent($id){
        try{
            $student=DB::table('students')->where('id',$id)->first();
            if(empty($student)){
            Log::info("Student Not Found for iD: {$id}");
            return $this->notFoundError('Student Not Found!');
            }
            Log::info("Data Successfully Showed for Id:{$id}");
            return $this->success('Data Successfully Showed');
        }
        catch(\Exception $e){
            Log::error("Data fetch Unsuccessful for Id:{$id}");
            return $this->genericError($e,'Data fetch Unsuccessful!');
        }
    }

  public function editStudent($id)
{
    try {
        $student = DB::table('students')->where('id', $id)->first();

        if (!$student) {
            Log::warning("Student not found for ID: {$id}");
            return $this->notFoundError('Student Not Found!');
        }
        Log::info("Student data fetched for editing. ID: {$id}");

        return response()->json($student);

    } catch (\Exception $e) {
        Log::error("Error in editStudent: " . $e->getMessage());
        return $this->genericError($e, 'Data fetch Unsuccessful!');
    }
}


    public function updateStudent(Request $request,$id){
        try{
            DB::beginTransaction();

            $request->validate([
            'student_name'=>'required',
            'age'=>'required',
            'student_image'=>'required',
           "student_email" => "required|email|unique:students,student_email,$id",
            'student_group_id'=>'required',
            ]);

            $student_data=DB::table('students')->where('id',$id)->first();

            if(!$student_data){
                Log::info("Student Not Found For Id: {$id}");
                return $this->notFoundError("Student Not Found For Update!");
            }

             $imageName = $student_data->student_image;

            if($request->hasFile("student_image")){
                if(!empty($student_data)){
                $this->destroyImage($student->student_image,'picture/student_image');
                Log::info("Image Successfully Unlinked for Id:{$id}");
            }
            $imageName = $this->storeImage($request->file('student_image'), "picture/student_image");
            Log::info("Image Successfully linked for Id:{$id}");

            }

            $data=[
                     'student_name'=>$request->student_name,
                     'age'=>$request->age,
                     'student_image'=> $imageName,
                     'student_email'=>$request->student_email,
                     'student_group_id'=>$request->student_group_id,
                     'updated_at'=>now (),
                 ];

                 DB::table('students')->where('id',$id)->update($data);
                 DB::commit();
                 Log::info("Student Data Successfully Updated for Id:{$id}");
                 return $this->success("Student Data Successfully Updated");

        }
          catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            Log::error("Validation Error At Update Student!");
            return $this->validationError($e, 'Please provide valid input.');
        }
        catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->genericError($e,'Student Data Update Unsuccessful!');


        }
    }

    public function destroyStudent($id){

        try{
            DB::beginTransacion();

            $student_data=DB::table('students')->where('id',$id)->first();
            
            if(empty($student_data)){
                Log::info("Student Data Empty To Delete for Id:{$id}");
                return $this->notFoundError("Student Not Found");
            }

            if(empty($student_data->student_image)){
                Log::info("Student Image is not Found for id:{$id}");
            }
            else{
                $this->destroyImage($student_data->student_image,'picture/student_image');
                Log::info("Student Image is Successfully Deleted for Id:{$id}");
            }
            DB::table('students')->where('id',$id)->delete();
            DB::commit();
            Log::info("Student Successfully Deleted for Id:{$id}");
            return $this->success('Student Successfuly Deleted!');
        }
        catch(\Exception $e){
            DB::rollBack();
            Log::error("Student Delete is Unsuccessful for Id:{$id}");
            return $this->genericError($e,"Student Data Delete Unsuccessful!");
        }

    }

    public function studentReport(Request $request){
        $students = null;
        
        if($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            
            $students = Student::select(
                'students.*',
                'student_groups.group_name',
                'contacts.phone'
            )
            ->leftJoin('student_groups', 'students.student_group_id', '=', 'student_groups.id')
            ->leftJoin('contacts', 'students.id', '=', 'contacts.student_id')
            ->where('students.student_email', 'LIKE', "%{$search}%")
            ->orWhere('students.id', $search)
            ->get();
        }
        
        return view('admin.extends.student.student_report', compact('students'));
    }
}
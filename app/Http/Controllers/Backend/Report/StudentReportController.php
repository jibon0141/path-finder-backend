<?php
namespace App\Http\Controllers\Backend\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;
use App\Models\StudentGroup;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class StudentReportController extends Controller
{

   public function index(Request $request)
{
    if ($request->ajax()) {


      
        $data = Student::with('studentGroup.subject')
               ->when(!empty($request->from_date) && !empty($request->to_date),function($query) use($request){
                  $startDate = Carbon::parse($request->from_date)->startOfDay();
                  $endDate = Carbon::parse($request->to_date)->endOfDay();
                $query->whereBetween('created_at',[$startDate, $endDate]);
               })
               ->when(!empty($request->student_group_id),function($query) use($request){
               return $query->where('student_group_id',$request->student_group_id);
               })
               ->when(!empty($request->student_name),function($query) use($request){
               return $query->where('student_name','like',"%{$request->student_name}%");
               })
               ->get();

              
             

    //     $query=Student::with('studentGroup.subject');
    //     if ($request->from_date && $request->to_date) {
    //         $startDate = Carbon::parse($request->from_date)->startOfDay();
    //         $endDate = Carbon::parse($request->to_date)->endOfDay();
    //         $query->whereBetween('created_at', [$startDate, $endDate]);
    //     }
        
    //     if ($request->student_group_id) {
    //         $query->where('student_group_id', $request->student_group_id);
    //     }
        
    //     if ($request->student_name) {
    //         $query->where('student_name', 'like', "%{$request->student_name}%");
    //     }
    //    $data=$query->get();
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('student_name', fn($row) => $row->student_name ?? '')
            ->addColumn('student_group', fn($row) => $row->studentGroup?->group_name ?? '')
            ->addColumn('subjects', fn($row) => 
                $row->studentGroup && $row->studentGroup->subject 
                    ? $row->studentGroup->subject->pluck('subject_name')->implode(', ')
                    : ''
            )
            ->make(true);
    }
       $studentGroups = StudentGroup::all();
       return view('admin.extends.report.student_report', compact('studentGroups'));
   
}


    public function searchStudent(Request $request){
        $term = $request->term;
        $students = DB::table('students')
            ->where('student_name', 'LIKE', "%{$term}%")
            ->orWhere('student_email', 'LIKE', "%{$term}%")
            ->orWhere('id', $term)
            ->limit(10)
            ->get();

        $result = [];
        foreach($students as $student) {
            $result[] = [
                'id' => $student->id,
                'name' => $student->student_name,
                'label' => $student->student_name . ' (' . $student->student_email . ')'
            ];
        }
        return response()->json($result);
    }
}

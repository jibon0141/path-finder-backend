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
            try {
                $query = Student::with(['studentGroup.subject'])
                    ->when(!empty($request->from_date) && !empty($request->to_date), function ($q) use ($request) {
                        $startDate = Carbon::parse($request->from_date)->startOfDay();
                        $endDate = Carbon::parse($request->to_date)->endOfDay();
                        return $q->whereBetween('created_at', [$startDate, $endDate]);
                    })
                    ->when(!empty($request->student_group_id), function ($q) use ($request) {
                        return $q->where('student_group_id', $request->student_group_id);
                    })
                    ->when(!empty($request->student_name), function ($q) use ($request) {
                        return $q->where('student_name', 'like', "%{$request->student_name}%");
                    });

                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('student_name', function ($row) {
                        return $row->student_name ?? '-';
                    })
                    ->addColumn('student_group', function ($row) {
                        return $row->studentGroup->group_name ?? '-';
                    })
                    ->addColumn('subjects', function ($row) {
                        if (!empty($row->studentGroup) && !empty($row->studentGroup->subject) && $row->studentGroup->subject->isNotEmpty()) {
                            return $row->studentGroup->subject->pluck('subject_name')->filter()->implode(', ');
                        }
                        return '-';
                    })
                    ->rawColumns(['subjects'])
                    ->make(true);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Student Report DataTables Error: ' . $e->getMessage());
                return response()->json([
                    'draw' => intval($request->get('draw', 1)),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'error' => $e->getMessage()
                ], 500);
            }
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

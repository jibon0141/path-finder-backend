<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $totalStudents = DB::table('students')->count();
        $totalServices = DB::table('services')->count();
        $totalCategories = DB::table('categories')->count();
        $totalReviews = DB::table('reviews')->count();
        $totalAccounts = DB::table('accounts')->count();
        $totalAdmins = DB::table('admins')->count();

        $recentStudents = DB::table('students')
            ->leftJoin('student_groups', 'students.student_group_id', '=', 'student_groups.id')
            ->select('students.*', 'student_groups.group_name')
            ->orderBy('students.id', 'desc')
            ->limit(5)
            ->get();

        return view("admin.dashboard", compact(
            'totalStudents',
            'totalServices',
            'totalCategories',
            'totalReviews',
            'totalAccounts',
            'totalAdmins',
            'recentStudents'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $totalCourses = Course::count();
        $totalStudents = Student::count();

        $coursesWithStudents = Course::with('students')->get();

        return view('dashboard.index', compact('totalCourses', 'totalStudents', 'coursesWithStudents'));
    }
}

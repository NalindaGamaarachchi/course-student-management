<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::when($search, function ($query, $search) {
            $searchTerm = '%' . $search . '%';
            return $query->where('name', 'like', $searchTerm)
                ->orWhere('email', 'like', $searchTerm);
        })->get();

        return view('students.index', compact('students', 'search'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }
        return view('students.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function assignCourses(Request $request, Student $student)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $courseIds = $request->input('courses', []);

        $student->courses()->sync($courseIds);

        return redirect()->route('students.index')
            ->with('success', 'Courses assigned successfully!');
    }
}

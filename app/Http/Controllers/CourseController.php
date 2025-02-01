<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $courses = Course::when($search, function ($query, $search) {
            $searchTerm = '%' . $search . '%';
            return $query->where('title', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm);
        })->withCount('students')->get();

        return view('courses.index', compact('courses', 'search'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }
        return view('courses.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}

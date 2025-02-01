@extends('layouts.app')

@section('content')
<h1>Students</h1>

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('students.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control" placeholder="Search students..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>
                @foreach($student->courses as $course)
                <span class="badge bg-info text-dark">{{ $course->title }}</span>
                @endforeach
            </td>
            <td>
                <!-- "Assign Courses" button -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#assignCoursesModal{{ $student->id }}">
                    Assign Courses
                </button>

                <!-- Edit and Delete Buttons as before -->
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>

        <!-- Modal for assigning courses -->
        <div class="modal fade" id="assignCoursesModal{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('students.assignCourses', $student->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Courses to {{ $student->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php
                            // If you prefer not to fetch in the blade, you could pass $allCourses from your controller
                            $allCourses = \App\Models\Course::all();
                            @endphp
                            @foreach($allCourses as $course)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    name="courses[]"
                                    value="{{ $course->id }}"
                                    id="course_{{ $student->id }}_{{ $course->id }}"
                                    {{ $student->courses->contains($course->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="course_{{ $student->id }}_{{ $course->id }}">
                                    {{ $course->title }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Assignments</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
@endsection
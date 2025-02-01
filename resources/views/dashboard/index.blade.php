@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Total Courses</h5>
                <h3>{{ $totalCourses }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Total Students</h5>
                <h3>{{ $totalStudents }}</h3>
            </div>
        </div>
    </div>
</div>

<div>
    <h3 class="mb-3">Courses & Enrolled Students</h3>
    <div class="row">
        @foreach($coursesWithStudents as $course)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $course->title }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ $course->description }}</p>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($course->students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">No students enrolled.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
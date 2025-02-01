@extends('layouts.app')

@section('content')
<h1>Courses</h1>

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ route('courses.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control" placeholder="Search courses..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Create Course</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th># Enrolled</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- In courses/index.blade.php -->

        @foreach($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->title }}</td>
            <td>{{ $course->description }}</td>
            <td>{{ $course->students_count }}</td>
            <td>
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Delete Button that triggers modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseModal{{ $course->id }}">
                    Delete
                </button>

                <!-- Confirmation Modal -->
                <div class="modal fade" id="deleteCourseModal{{ $course->id }}" tabindex="-1" aria-labelledby="deleteCourseModalLabel{{ $course->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCourseModalLabel{{ $course->id }}">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the course <strong>{{ $course->title }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection
@extends('layouts.app')

@section('content')
<h1>Student Details</h1>

<div class="mb-3">
    <strong>Name:</strong> {{ $student->name }}
</div>
<div class="mb-3">
    <strong>Email:</strong> {{ $student->email }}
</div>
<div class="mb-3">
    <strong>Courses:</strong>
    @forelse($student->courses as $course)
    <span class="badge bg-info text-dark">{{ $course->title }}</span>
    @empty
    <span>No courses assigned.</span>
    @endforelse
</div>
<a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
@endsection
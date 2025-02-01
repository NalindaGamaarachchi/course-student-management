<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (Super Admin Only)
Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

// Role Management (Super Admin Only)
Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/users/{user}/assign-role', [RoleController::class, 'assignRole'])->name('users.assignRole');
});

// Courses & Students (General & Super Admins)
Route::middleware(['auth'])->group(function () {
    // General access
    Route::resource('courses', CourseController::class)->except(['edit', 'update', 'destroy']);
    Route::resource('students', StudentController::class)->except(['edit', 'update', 'destroy']);

    // Assign Courses (For Admins)
    Route::post('/students/{student}/assign-courses', [StudentController::class, 'assignCourses'])
        ->name('students.assignCourses');

    // Super Admins can edit/delete courses & students
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('courses', CourseController::class)->only(['edit', 'update', 'destroy']);
        Route::resource('students', StudentController::class)->only(['edit', 'update', 'destroy']);
    });
});

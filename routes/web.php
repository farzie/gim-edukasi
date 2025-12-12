<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PythonController;


// 1. Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/playground', [PageController::class, 'playground'])->name('playground');
Route::get('/bantuan', [PageController::class, 'help'])->name('help');

// 2. Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
    // Register Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
});

// 3. Protected Routes (Login Required)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes untuk Courses -----
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{slug}/challenge/{challenge}', [CourseController::class, 'challenge'])->name('courses.challenge');

    // Save Progress Route
    Route::post('/challenge/complete', [PythonController::class, 'markComplete'])->name('challenge.complete');

    // Route Baca Materi (Lesson)
    Route::get('/courses/{slug}/lesson/{challenge}', [CourseController::class, 'lesson'])->name('courses.lesson');
    
    // Route Sandbox (Praktek) - Tetap ada
    Route::get('/courses/{slug}/practice/{challenge}', [CourseController::class, 'challenge'])->name('courses.challenge');
});

// Route eksekusi python
Route::post('/run-python', [PythonController::class, 'run'])->name('python.run');
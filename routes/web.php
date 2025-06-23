<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;

// Rute Kursus
Route::get('/', [CourseController::class, 'index'])->name('home');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

// --- RUTE OTENTIKASI ---

// Rute yang hanya bisa diakses Tipe Tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

// Rute yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // <-- Tambahkan rute ini
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/courses/{course:slug}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
     Route::get('/courses/{course:slug}/lessons/{lesson:slug}', [LessonController::class, 'show'])->name('lessons.show');

});
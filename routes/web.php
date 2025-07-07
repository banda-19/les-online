<?php

use Illuminate\Support\Facades\Route;

// --- Controller untuk Publik dan User Biasa ---
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;

// --- Controller KHUSUS untuk Admin ---
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\UserController;


/*
|--------------------------------------------------------------------------
| Rute Publik & Otentikasi
|--------------------------------------------------------------------------
*/

// Halaman utama dan detail kursus (bisa diakses siapa saja)
Route::get('/', [CourseController::class, 'index'])->name('home');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

// Rute untuk registrasi dan login (hanya untuk tamu/guest)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});


/*
|--------------------------------------------------------------------------
| Rute untuk Pengguna yang Sudah Login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard untuk pengguna biasa
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Proses logout
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    // Proses untuk mendaftar & melihat materi kursus
    Route::post('/courses/{course:slug}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/courses/{course:slug}/lessons/{lesson:slug}', [LessonController::class, 'show'])->name('lessons.show');

    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');

});



/*
|--------------------------------------------------------------------------
| Rute KHUSUS untuk Panel Admin
|--------------------------------------------------------------------------
|
| Semua rute di sini dilindungi oleh prefix '/admin',
| middleware 'auth' (harus login), dan middleware 'admin' (harus admin).

*/

// Rute untuk menampilkan & memproses form login admin
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);

// Rute untuk logout dari panel admin
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

    // Dashboard Admin -> /admin
    // Menggunakan AdminDashboardController agar tidak bentrok
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute CRUD untuk kursus -> /admin/courses
    Route::resource('courses', AdminCourseController::class);

    // Anda bisa menambahkan rute admin lain di sini
     Route::resource('lessons', \App\Http\Controllers\Admin\LessonController::class);
    
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});
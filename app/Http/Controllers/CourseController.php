<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Fungsi untuk menampilkan semua kursus di halaman utama
public function index()
{
    // 1. Ambil semua kursus yang tersedia
    $allCourses = Course::latest()->get();

    // 2. Siapkan variabel untuk kursus milik pengguna
    $myCourses = collect();

    // 3. Cek jika pengguna login
    if (Auth::check()) {
        // Ambil kursus yang dia ikuti
        $myCourses = Auth::user()->courses()->latest()->get();

        // 4. INI BAGIAN PENTINGNYA:
        // Hapus kursus yang ada di $myCourses dari koleksi $allCourses
        $allCourses = $allCourses->diff($myCourses);
    }

    // 5. Kirim data yang sudah bersih ke view
    return view('courses.index', [
        'allCourses' => $allCourses,
        'myCourses' => $myCourses
    ]);
}
    // Fungsi untuk menampilkan detail satu kursus
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
   public function enroll(Course $course)
{
    $user = Auth::user();

    // Cek apakah user sudah terdaftar di kursus ini
    $isEnrolled = $user->courses()->where('course_id', $course->id)->exists();

    if ($isEnrolled) {
        // Jika sudah, kembalikan dengan pesan info
        return redirect()->route('courses.show', $course->slug)
            ->with('info', 'Anda sudah terdaftar di kursus ini.');
    }

    // Jika belum, daftarkan user ke kursus (attach ke pivot table)
    $user->courses()->attach($course->id);

    // Kembalikan dengan pesan sukses
    return redirect()->route('courses.show', $course->slug)
        ->with('success', 'Selamat! Anda telah berhasil mendaftar di kursus: ' . $course->title);
}
}
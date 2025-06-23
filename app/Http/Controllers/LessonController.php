<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function show(Course $course, Lesson $lesson)
{
    // Pastikan lesson yang diakses adalah milik course yang benar
    if ($lesson->course_id !== $course->id) {
        abort(404);
    }

    // PERIKSA HAK AKSES: Cek apakah pengguna sudah terdaftar di kursus ini
    if (!Auth::user()->courses->contains($course)) {
        return redirect()->route('courses.show', $course->slug)->with('info', 'Anda harus mendaftar di kursus ini untuk melihat materinya.');
    }

    // LOGIKA BARU UNTUK NAVIGASI MATERI
    // 1. Ambil semua lesson dari kursus ini, diurutkan berdasarkan ID.
    $allLessons = $course->lessons;

    // 2. Cari posisi (index) dari lesson yang sedang dibuka saat ini.
    $currentLessonIndex = $allLessons->search(function($item) use ($lesson) {
        return $item->id === $lesson->id;
    });

    // 3. Cari materi sebelum dan sesudahnya.
    $previousLesson = $allLessons->get($currentLessonIndex - 1);
    $nextLesson = $allLessons->get($currentLessonIndex + 1);

    // Jika semua pengecekan lolos, tampilkan halaman materi
    // dan kirim data materi sebelum/sesudahnya.
    return view('lessons.show', compact('course', 'lesson', 'previousLesson', 'nextLesson'));
}
}
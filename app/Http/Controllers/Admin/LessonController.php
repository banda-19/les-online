<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index()
    {
        // Ambil data lesson beserta data kursusnya (relasi)
        $lessons = Lesson::with('course')->latest()->paginate(10);
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        // Ambil semua kursus untuk ditampilkan di dropdown
        $courses = Course::orderBy('title')->get();
        return view('admin.lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:video,artikel',
            'content' => 'required|string',
            'duration_in_minutes' => 'required|integer|min:1',
        ]);
        $validated['slug'] = Str::slug($validated['title']);

        Lesson::create($validated);
        return redirect()->route('admin.lessons.index')->with('success', 'Materi baru berhasil ditambahkan.');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:video,artikel',
            'content' => 'required|string',
            'duration_in_minutes' => 'required|integer|min:1',
        ]);
        $validated['slug'] = Str::slug($validated['title']);

        $lesson->update($validated);
        return redirect()->route('admin.lessons.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.lessons.index')->with('success', 'Materi berhasil dihapus.');
    }
}
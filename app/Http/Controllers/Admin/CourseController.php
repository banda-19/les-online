<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'thumbnail' => 'nullable|url', // Validasi diubah menjadi URL
    ]);

    $courseData = $validated;
    $courseData['slug'] = Str::slug($validated['title']);

    Course::create($courseData);

    return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil ditambahkan.');
}

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

   public function update(Request $request, Course $course)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'thumbnail' => 'nullable|url', // Validasi diubah menjadi URL
    ]);

    $courseData = $validated;
    $courseData['slug'] = Str::slug($validated['title']);

    $course->update($courseData);

    return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui.');
}
    public function destroy(Course $course)
    {
        // Hapus gambar terkait
        // Storage::disk('public')->delete($course->thumbnail);
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus.');
    }
}
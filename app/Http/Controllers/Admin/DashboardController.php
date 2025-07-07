<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalLessons = Lesson::count();
        $totalUsers = User::where('role', 'user')->count(); // Hanya menghitung user biasa

        return view('admin.dashboard', compact('totalCourses', 'totalLessons', 'totalUsers'));
    }
}
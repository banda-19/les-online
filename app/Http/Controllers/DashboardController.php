<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data kursus milik user yang sedang login
        $myCourses = Auth::user()->courses()->latest()->get();

        return view('dashboard', compact('myCourses'));
    }
}
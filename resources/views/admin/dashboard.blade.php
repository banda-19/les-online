@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="mt-1 text-gray-600">Berikut adalah ringkasan dari platform LesOnline Anda.</p>
    </div>
    
    {{-- Grid untuk Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Kursus</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalCourses }}</p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Materi</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalLessons }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between hover:shadow-lg transition-shadow duration-300">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.5-2.964A3 3 0 0 0 10.5 12a3 3 0 0 0-3 3m0 0a3 3 0 0 0 5.958 2.046m-5.958-2.046A3 3 0 0 0 4.5 12a3 3 0 0 0-3 3m15-9a3 3 0 0 0-3-3m0 0a3 3 0 0 0-3 3m3-3a3 3 0 0 0-3-3m-3.75 6a3 3 0 0 0-3-3m0 0a3 3 0 0 0-3 3m3 3a3 3 0 0 0 3 3m0 0a3 3 0 0 0 3-3m-3 3a3 3 0 0 0 3-3m0 0a3 3 0 0 0-3-3" /></svg>
            </div>
        </div>

    </div>
@endsection
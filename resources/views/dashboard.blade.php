@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-8">Kursus Saya</h1>

    @if($myCourses->isEmpty())
        <div class="text-center bg-white p-12 rounded-lg shadow">
            <p class="text-gray-500">Anda belum terdaftar di kursus manapun.</p>
            <a href="/" class="mt-4 inline-block bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700">
                Cari Kursus Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($myCourses as $course)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img class="h-48 w-full object-cover" src="{{ $course->thumbnail ?? 'https://via.placeholder.com/400x200?text=LesOnline' }}" alt="{{ $course->title }}">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h2>
                        <a href="{{ route('courses.show', $course->slug) }}" class="mt-4 inline-block w-full text-center bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Lanjutkan Belajar
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
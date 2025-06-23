@extends('layouts.app')

@section('content')
    @auth
        <div class="mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Selamat Datang Kembali, <span class="text-indigo-600">{{ Auth::user()->name }}</span>!</h1>
            <p class="mt-2 text-lg text-gray-500">Siap untuk melanjutkan petualangan belajarmu hari ini?</p>
        </div>

        @if(!$myCourses->isEmpty())
            <div class="mb-12">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Kursus yang Sedang Anda Ikuti</h2>
                <div class="flex overflow-x-auto space-x-6 pb-4 -mx-4 px-4">
                    @foreach ($myCourses as $course)
                        <div class="flex-shrink-0 w-80 md:w-96">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden h-full flex flex-col transform hover:scale-105 transition-transform duration-300 ease-in-out">
                                <img class="h-48 w-full object-cover" src="{{ $course->thumbnail ?? 'https://via.placeholder.com/400x200?text=LesOnline' }}" alt="{{ $course->title }}">
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h3>
                                    <div class="mt-4">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Progres</span>
                                            <span class="text-sm font-medium text-indigo-700">25%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 25%"></div>
                                        </div>
                                    </div>
                                    <div class="mt-auto pt-4">
                                        <a href="{{ route('courses.show', $course->slug) }}" class="inline-flex items-center justify-center w-full text-center bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 ease-in-out">
                                            Lanjutkan Belajar
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class="my-12 border-t-2 border-gray-200">
        @endif
    @endauth

    <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-8">Kursus Tersedia</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($allCourses as $course)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 ease-in-out relative">
                <img class="h-48 w-full object-cover" src="{{ $course->thumbnail ?? 'https://via.placeholder.com/400x200?text=LesOnline' }}" alt="{{ $course->title }}">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ \Illuminate\Support\Str::limit($course->title, 50) }}</h2>
                    <p class="mt-2 text-gray-600 h-20">{{ \Illuminate\Support\Str::limit($course->description, 100) }}</p>
                    <a href="{{ route('courses.show', $course->slug) }}" class="inline-flex items-center justify-center mt-4 bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300 ease-in-out">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">Tidak ada kursus baru yang tersedia untuk Anda saat ini.</p>
        @endforelse
    </div>
@endsection
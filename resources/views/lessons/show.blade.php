@extends('layouts.app')

@section('content')
    {{-- Breadcrumbs --}}
    <div class="mb-6 text-sm text-gray-500">
        <a href="/" class="hover:text-indigo-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-indigo-600">{{ $course->title }}</a>
        <span class="mx-2">/</span>
        <span class="font-semibold text-gray-800">{{ $lesson->title }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- KOLOM UTAMA: KONTEN MATERI --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-4 md:p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $lesson->title }}</h1>

                {{-- =================================== --}}
                {{--    BAGIAN KONTEN YANG DIPERBAIKI    --}}
                {{-- =================================== --}}
                @if($lesson->type == 'video')
                    <div class="aspect-w-16 aspect-h-9 mb-6">
                        <iframe class="w-full h-full rounded-lg shadow-lg" src="{{ $lesson->content }}" title="Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @elseif($lesson->type == 'artikel')
                    {{-- Tanda {!! !!} digunakan agar tag HTML (seperti <h2>, <p>) di dalam konten bisa dirender --}}
                    <div class="prose prose-lg max-w-none p-6 bg-gray-50 rounded-lg border">
                        {!! $lesson->content !!}
                    </div>
                @endif
            </div>
        </div>

        {{-- SIDEBAR: DAFTAR MATERI --}}
        <div class="lg:col-span-1">
             <div class="bg-white p-6 rounded-lg shadow-lg sticky top-24">
                 <h3 class="text-xl font-bold mb-4">Daftar Materi</h3>
                 <div class="space-y-2">
                     @foreach($course->lessons as $listLesson)
                        {{-- Memberi background berbeda untuk materi yang sedang aktif --}}
                        <a href="{{ route('lessons.show', ['course' => $course->slug, 'lesson' => $listLesson->slug]) }}"
                           class="block p-3 border rounded-lg transition @if($listLesson->id === $lesson->id) bg-indigo-100 border-indigo-400 @else hover:bg-gray-50 @endif">
                            <div class="flex items-center">
                                @if($listLesson->type == 'video')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-500 mr-3 flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9A2.25 2.25 0 0 0 13.5 5.25h-9a2.25 2.25 0 0 0-2.25 2.25v9A2.25 2.25 0 0 0 4.5 18.75Z" /></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-sky-500 mr-3 flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                @endif
                                <span class="font-medium text-sm text-gray-800">{{ $loop->iteration }}. {{ $listLesson->title }}</span>
                            </div>
                        </a>
                     @endforeach
                 </div>
             </div>
        </div>
    </div>


    {{-- =================================== --}}
    {{--    BAGIAN TOMBOL NAVIGASI DIPERBAIKI   --}}
    {{-- =================================== --}}
    <div class="flex justify-between mt-10 pt-6 border-t">
        @if($previousLesson)
            <a href="{{ route('lessons.show', ['course' => $course->slug, 'lesson' => $previousLesson->slug]) }}" class="inline-flex items-center bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                Materi Sebelumnya
            </a>
        @else
             <span class="inline-flex items-center bg-gray-200 text-gray-400 px-4 py-2 rounded-lg cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                Materi Sebelumnya
            </span>
        @endif

        @if($nextLesson)
            <a href="{{ route('lessons.show', ['course' => $course->slug, 'lesson' => $nextLesson->slug]) }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Materi Selanjutnya
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
            </a>
        @else
             <span class="inline-flex items-center bg-gray-200 text-gray-400 px-4 py-2 rounded-lg cursor-not-allowed">
                Materi Selanjutnya
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
            </span>
        @endif
    </div>
@endsection
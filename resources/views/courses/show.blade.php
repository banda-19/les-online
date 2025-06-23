@extends('layouts.app')

@section('content')
    <div class="mb-6 text-sm text-gray-500">
        <a href="/" class="hover:text-indigo-600">Home</a>
        <span class="mx-2">/</span>
        <span class="font-semibold text-gray-800">{{ $course->title }}</span>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg">
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('info'))
            <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded" role="alert">
                {{ session('info') }}
            </div>
        @endif

        <div class="md:flex md:gap-x-8">
            <div class="md:w-2/3">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">{{ $course->title }}</h1>
                <p class="mt-4 text-lg text-gray-600">{{ \Illuminate\Support\Str::limit($course->description, 150) }}</p>
                <div class="mt-6 flex items-center gap-x-6 text-sm">
                    <span class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-100 px-2 py-1 font-medium text-blue-700">Kategori: Programming</span>
                    <span class="inline-flex items-center gap-x-1.5 rounded-md bg-green-100 px-2 py-1 font-medium text-green-700">Level: Pemula</span>
                </div>
                <div class="mt-8 md:hidden">
                    @include('courses.partials.action-button')
                </div>
            </div>

            <div class="md:w-1/3 mt-8 md:mt-0">
                <img class="rounded-lg shadow-lg w-full object-cover" src="{{ $course->thumbnail ?? 'https://placehold.co/600x400/888bff/ffffff?text=LesOnline' }}" alt="{{ $course->title }}">
                <div class="hidden md:block mt-4">
                     @include('courses.partials.action-button')
                </div>
            </div>
        </div>

           <div class="mt-12 pt-8 border-t">
             <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Kursus Ini</h2>
             <div class="prose prose-lg max-w-none text-gray-700">
                {!! nl2br(e($course->description)) !!}
             </div>
        </div>

        <div class="mt-12 pt-8 border-t">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Materi Pembelajaran</h2>
    <div class="space-y-4">
        @auth
            @if(Auth::user()->courses->contains($course))
                {{-- JIKA SUDAH DAFTAR: Tampilkan daftar materi --}}
                @forelse ($course->lessons as $lesson)
                    <a href="{{ route('lessons.show', ['course' => $course->slug, 'lesson' => $lesson->slug]) }}" class="block p-4 border rounded-lg hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-500 mr-4"><path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9A2.25 2.25 0 0 0 13.5 5.25h-9a2.25 2.25 0 0 0-2.25 2.25v9A2.25 2.25 0 0 0 4.5 18.75Z" /></svg>
                                <span class="font-medium text-gray-800">{{ $loop->iteration }}. {{ $lesson->title }}</span>
                            </div>
                            <span class="text-sm text-gray-500">{{ $lesson->duration_in_minutes }} Menit</span>
                        </div>
                    </a>
                @empty
                    <div class="bg-gray-100 p-6 rounded-lg text-center">
                        <p class="text-gray-500">Materi untuk kursus ini belum tersedia.</p>
                    </div>
                @endforelse
            @else
                {{-- JIKA BELUM DAFTAR: Tampilkan pesan terkunci --}}
                <div class="bg-gray-100 p-6 rounded-lg text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    <p class="font-semibold">Materi Terkunci</p>
                    <p class="text-gray-500">Daftar terlebih dahulu untuk mengakses materi pembelajaran.</p>
                </div>
            @endif
        @else
            {{-- JIKA TIDAK LOGIN: Tampilkan pesan terkunci --}}
             <div class="bg-gray-100 p-6 rounded-lg text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                <p class="font-semibold">Materi Terkunci</p>
                <p class="text-gray-500">Login dan daftar terlebih dahulu untuk mengakses materi.</p>
            </div>
        @endauth
    </div>
</div>
@endsection
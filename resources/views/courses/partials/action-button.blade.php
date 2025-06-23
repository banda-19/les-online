{{-- resources/views/courses/partials/action-button.blade.php --}}

@auth
    @if(Auth::user()->courses->contains($course))
        <a href="{{ route('dashboard') }}" class="block text-center w-full bg-gray-500 text-white font-bold py-3 px-6 rounded-lg text-lg">
            Anda Sudah Terdaftar
        </a>
    @else
        <form action="{{ route('courses.enroll', $course->slug) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-6 rounded-lg text-lg hover:bg-green-700 transition-colors">
                Ikuti Kursus Ini Sekarang
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" class="block text-center w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg text-lg hover:bg-blue-700 transition-colors">
        Login untuk Mengikuti Kursus
    </a>
@endauth
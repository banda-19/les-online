@csrf
<div class="space-y-6">
    <div>
        <label for="course_id" class="block text-sm font-medium text-gray-700">Pilih Kursus</label>
        <select id="course_id" name="course_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" @selected(old('course_id', $lesson->course_id ?? '') == $course->id)>
                    {{ $course->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Materi</label>
        <input type="text" name="title" id="title" value="{{ old('title', $lesson->title ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Tipe Materi</label>
        <div class="mt-2 space-x-4">
            <label><input type="radio" name="type" value="video" @checked(old('type', $lesson->type ?? 'video') == 'video')> Video</label>
            <label><input type="radio" name="type" value="artikel" @checked(old('type', $lesson->type ?? '') == 'artikel')> Artikel</label>
        </div>
    </div>

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Konten (URL Video atau Isi Artikel)</label>
        <textarea name="content" id="content" rows="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content', $lesson->content ?? '') }}</textarea>
        @error('content') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="duration_in_minutes" class="block text-sm font-medium text-gray-700">Durasi (Menit)</label>
        <input type="number" name="duration_in_minutes" id="duration_in_minutes" value="{{ old('duration_in_minutes', $lesson->duration_in_minutes ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('duration_in_minutes') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex justify-end pt-4">
        <a href="{{ route('admin.lessons.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md mr-2 hover:bg-gray-300">Batal</a>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Simpan</button>
    </div>
</div>
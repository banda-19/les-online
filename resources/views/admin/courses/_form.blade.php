@csrf
<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Kursus</label>
        <input type="text" name="title" id="title" value="{{ old('title', $course->title ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <p class="mt-1 text-xs text-gray-500">Judul akan otomatis diubah menjadi slug (untuk URL).</p>
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" id="description" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $course->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="thumbnail" class="block text-sm font-medium text-gray-700">Link URL Thumbnail</label>
        <input type="url" name="thumbnail" id="thumbnail" placeholder="https://example.com/image.jpg" value="{{ old('thumbnail', $course->thumbnail ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <p class="mt-1 text-xs text-gray-500">Tempel link gambar penuh yang diawali dengan https://</p>
        @error('thumbnail')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if(isset($course) && $course->thumbnail)
            <div class="mt-4">
                <p class="text-sm text-gray-500">Pratinjau gambar:</p>
                <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="mt-2 w-48 h-auto rounded-md border">
            </div>
        @endif
    </div>

    <div class="flex justify-end pt-4 border-t mt-6">
        <a href="{{ route('admin.courses.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</a>
        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
            {{ isset($course) ? 'Perbarui Kursus' : 'Simpan Kursus' }}
        </button>
    </div>
</div>
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil kursus Laravel
        $laravelCourse = Course::where('slug', 'dasar-dasar-laravel-11')->first();

        if ($laravelCourse) {
            $laravelLessons = [
                ['title' => 'Pengenalan dan Instalasi Laravel', 'video_url' => 'https://www.youtube.com/embed/MPGD23QJknc', 'duration' => 15, 'desc' => 'Mengenal framework Laravel dan melakukan instalasi awal menggunakan Composer.'],
                ['title' => 'Struktur Folder dan Konsep Routing', 'video_url' => 'https://www.youtube.com/embed/aGzwI6t-OR8', 'duration' => 20, 'desc' => 'Memahami struktur direktori Laravel dan cara kerja sistem routing untuk menangani request.'],
                ['title' => 'Views dan Blade Templating Engine', 'video_url' => 'https://www.youtube.com/embed/pGg_gY_kY8E', 'duration' => 25, 'desc' => 'Mempelajari cara membuat tampilan dinamis menggunakan Blade, templating engine bawaan Laravel.'],
                ['title' => 'Controller dan Passing Data ke View', 'video_url' => 'https://www.youtube.com/embed/TzA2C6e-2FA', 'duration' => 18, 'desc' => 'Mengorganisir logika aplikasi dengan Controller dan cara mengirim data ke tampilan Blade.'],
            ];

            foreach ($laravelLessons as $lesson) {
                Lesson::create([
                    'course_id' => $laravelCourse->id,
                    'title' => $lesson['title'],
                    'slug' => Str::slug($lesson['title']),
                    'video_url' => $lesson['video_url'],
                    'description' => $lesson['desc'],
                    'duration_in_minutes' => $lesson['duration'],
                ]);
            }
        }

        // Ambil kursus PHP OOP
        $phpCourse = Course::where('slug', 'php-object-oriented-programming-oop')->first();

        if ($phpCourse) {
            $phpLessons = [
                ['title' => 'Apa itu OOP? Konsep Dasar', 'video_url' => 'https://www.youtube.com/embed/N5c_2329wLg', 'duration' => 12, 'desc' => 'Memahami pilar-pilar utama OOP dan mengapa ini penting dalam pengembangan perangkat lunak.'],
                ['title' => 'Class, Object, Property, dan Method', 'video_url' => 'https://www.youtube.com/embed/5t1D9M1WD3A', 'duration' => 16, 'desc' => 'Mempelajari blok bangunan dasar dari OOP: Class sebagai blueprint dan Object sebagai instance.'],
                ['title' => 'Inheritance (Pewarisan)', 'video_url' => 'https://www.youtube.com/embed/6i250iHDe5k', 'duration' => 22, 'desc' => 'Menggunakan konsep inheritance untuk menciptakan hierarki class dan mengurangi duplikasi kode.'],
            ];

            foreach ($phpLessons as $lesson) {
                Lesson::create([
                    'course_id' => $phpCourse->id,
                    'title' => $lesson['title'],
                    'slug' => Str::slug($lesson['title']),
                    'video_url' => $lesson['video_url'],
                    'description' => $lesson['desc'],
                    'duration_in_minutes' => $lesson['duration'],
                ]);
            }
        }
    }
}
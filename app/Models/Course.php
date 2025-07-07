<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users()
{
    return $this->belongsToMany(User::class, 'course_user');
}
    //
public function lessons()
{
    // Kita urutkan berdasarkan ID agar materi selalu tampil berurutan
    return $this->hasMany(Lesson::class)->orderBy('id');
}
 // TAMBAHKAN METHOD BARU INI
    public function getProgressAttribute(): int
    {
        if (!auth()->check()) {
            return 0;
        }

        $lessonIds = $this->lessons->pluck('id');
        $totalLessons = $lessonIds->count();

        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = auth()->user()->completedLessons()
                            ->whereIn('lesson_id', $lessonIds)
                            ->count();

        return round(($completedLessons / $totalLessons) * 100);
    }
}

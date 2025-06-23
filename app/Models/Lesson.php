<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
    'course_id',
    'title',
    'slug',
    'type', // <-- Baru
    'content', // <-- Baru
    'duration_in_minutes',
];

public function course()
{
    return $this->belongsTo(Course::class);
}

}

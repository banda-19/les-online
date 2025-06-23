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

}

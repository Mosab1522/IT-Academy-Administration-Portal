<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function class()
    {
         return $this->belongsTo(CourseClass::class);
    }
    public function instructor()
    {
         return $this->belongsTo(Instructor::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'lesson_students', 'lesson_id', 'student_id')->withTimestamps();
    }
}

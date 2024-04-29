<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[

    ];
    use HasFactory;


    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function classes()
    {
        return $this->belongsToMany(CourseClass::class, 'class_students', 'student_id', 'class_id')->withPivot('application_id')->withTimestamps();
    }
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_students', 'student_id', 'lesson_id')->withTimestamps();
    }
}

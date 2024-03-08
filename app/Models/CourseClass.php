<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function coursetype()
    {
        return $this->belongsTo(CourseType::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_students', 'class_id', 'student_id')->withPivot('application_id')->withTimestamps();
    }
}
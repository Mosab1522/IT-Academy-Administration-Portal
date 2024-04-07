<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Instructor extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $guarded = [ ];

    public function login()
    {
        return $this->hasOne(User::class,'user_id');
    }

    public function coursetypes()
    {
        return $this->belongsToMany(CourseType::class, 'coursetype_instructor', 'instructor_id', 'coursetype_id')->withTimestamps();
    }
    public function classes()
    {
        return $this->hasMany(CourseClass::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}

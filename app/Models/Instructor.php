<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    
    protected $guarded = [ ];

    public function login()
    {
        return $this->hasOne(User::class,'user_id');
    }

    public function coursetypes()
    {
        return $this->belongsToMany(CourseType::class, 'coursetype_instructor', 'instructor_id', 'coursetype_id');
    }
}

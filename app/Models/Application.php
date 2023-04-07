<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function coursetype()
    {
        return $this->belongsTo(CourseType::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

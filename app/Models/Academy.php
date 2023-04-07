<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coursetypes()
    {
        return $this->hasMany(CourseType::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}

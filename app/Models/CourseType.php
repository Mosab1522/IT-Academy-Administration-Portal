<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class,'coursetype_id');
    }
}

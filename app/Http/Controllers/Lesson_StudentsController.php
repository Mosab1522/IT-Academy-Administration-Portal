<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonStudentsController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'all' => ['required_if:who,1,in:on'],
           
        'students' => 'required_if:who,2,on|nullable|array',
        'students.*' => 'required_if:who,2|nullable|distinct|exists:students,id',
        ]);

        dd($attributes);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function create()
    {
        return view('create-application');
    }

    public function store()
    {
        
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => 'required|email|max:255|unique:applications,email,NULL,id,email,'.request()->email.',academy_id,'.request()->academy_id.',coursetype_id,'.request()->coursetype_id,
            'academy_id' => ['required', 'integer',Rule::exists('academies', 'id')],
            'coursetype_id' => ['required', 'integer',Rule::exists('course_types', 'id')],
            'days' => ['required', 'integer'],
            'time' => ['required', 'integer'],
        ]);

        Application::create($attributes);

        return back();
    }
}

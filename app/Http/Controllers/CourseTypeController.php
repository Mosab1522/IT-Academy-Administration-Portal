<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseTypeController extends Controller
{
    public function index()
    {
        return view('admin.coursetypes-index', [
            'coursetypes' => CourseType::with(['academy','applications'])->get()
        ]);
    }
    public function create(){
        return view('admin.coursetypes-create');
    }

    public function store(){
        $attributes = request()->validate([
            'name' => ['required', 'max:255',Rule::unique('course_types','name')],
            'academy_id' => ['required', 'integer', Rule::exists('academies','id')],
            'min' => ['required','integer','lte:max'],
            'max' => ['required','integer','gte:min'],
        ]);

        CourseType::create($attributes);

        return back();
    }
}

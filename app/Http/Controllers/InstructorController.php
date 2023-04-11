<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{

    public function index()
    {
        return view('admin.instructors-index', [
            'instructors' => Instructor::with(['coursetypes','login'])->get()
        ]);
    }
    public function create()
    {
        return view('admin.instructors-create');
    }
    
    public function store()
    {
        // dd(request()->all());
       
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('instructors', 'email')],
            'coursetypes_id' => ['array'],
            'coursetypes_id.*' => 'distinct|exists:course_types,id'
        
        ]);

        $instructor = Instructor::create([
            'name' => $attributes['name'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email']
        ]);
        if(request()->coursetypes_id){
        foreach(request()->coursetypes_id as $coursetype_id) {
            $coursetype = CourseType::find($coursetype_id);
            $instructor->coursetypes()->save($coursetype);
        }}

        session(['instructor_id' => $instructor['id']]);

        return redirect('/admin/login/create');
        
    }   
}

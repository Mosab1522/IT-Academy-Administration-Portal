<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CourseType_InstructorController extends Controller
{
    public function store()
    {
        $attributes = request()->validate(
            [
                'coursetype_id' => ['required', Rule::exists('course_types', 'id')],
                'instructor_id' => ['required', Rule::exists('instructors','id')]
            ]
        );
        $instructor = Instructor::find($attributes['instructor_id']);

        foreach($instructor->coursetypes as $coursetype){
            
            if($coursetype->id == $attributes['coursetype_id'])
            {
                return back();
            }
        }       
        // dd($coursetypes);
        $coursetype = CourseType::find($attributes['coursetype_id']);
        $instructor->coursetypes()->save($coursetype);



        return back();
    }

    public function destroy(Instructor $instructor, CourseType $coursetype)
    {
    //     dd($coursetype);
    //     $attributes = request()->validate(
    //     [
    //         'coursetype_id' => ['nullable', Rule::exists('course_types', 'id')],
    //         'instructor_id' => ['nullable', Rule::exists('instructors','id')]
    //     ]
    // );
        // $instructor ? $instructor->coursetypes()->detach($attributes['coursetype_id']) : $coursetype->instructors()->detach($attributes['instructor_id']);
        $instructor->coursetypes()->detach($coursetype['id']);
        // if ($instructor){
            
        // }
        // else if ($coursetype){
            
        // }
        return back()->with('success', 'Post deleted successfully');
    }
}

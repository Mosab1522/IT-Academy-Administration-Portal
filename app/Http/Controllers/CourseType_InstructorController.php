<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseType_InstructorController extends Controller
{
    public function store()
    {
        $attributes = request()->validate(
            [
                'coursetype_id' => ['required', Rule::exists('course_types', 'id')],
                'instructor_id' => ['required', Rule::exists('instructors', 'id')]
            ]
        );
        $instructor = Instructor::find($attributes['instructor_id']);

        foreach ($instructor->coursetypes as $coursetype) {

            if ($coursetype->id == $attributes['coursetype_id']) {
                return back();
            }
        }
        // dd($coursetypes);
        $coursetype = CourseType::find($attributes['coursetype_id']);
        $instructor->coursetypes()->save($coursetype);


        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }

        return back()->with('success_cc', 'Úspešne pridané');
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
        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        // }
        return back()->with('success_dd', 'Úspešne vymazané');
    }
}

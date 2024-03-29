<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseClass;
use App\Models\CourseType;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Class_StudentController extends Controller
{
    public function store()
    {

        $attributes = request()->validate([
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'student_id' => ['required_without_all:name,lastname,email', 'integer', Rule::exists('students', 'id')],
            'name' => ['required_without:student_id', 'max:255'],
            'lastname' => ['required_without:student_id', 'max:255'],
            'email' => ['required_without:student_id', 'email', 'max:255'],
        ]);
        $class = CourseClass::findOrFail($attributes['class_id']);
        if (isset($attributes['student_id'])) {
            if ($class->students()->where('student_id', $attributes['student_id'])->exists()) {
                return back()->with('message', 'Student is already in the class.');
            }
            $application = Application::where('student_id', $attributes['student_id'])
                ->where('coursetype_id', $class->coursetype->id)
                ->first();
            // Attempt to retrieve an application for the student

        } else {
            $student = Student::where(function ($query) use ($attributes) {
                $query->where('email', $attributes['email'])
                    ->orWhere('sekemail', $attributes['email']);
            })->first();
            if ($class->students()->where('student_id', $student['id'])->exists()) {
                return back()->with('message', 'Student is already in the class.');
            }
            $application = Application::where('student_id', $student['id'])
                ->where('coursetype_id', $class->coursetype->id)
                ->first();
        }


        // Corrected to find a CourseClass, not a Student


        // Check if the student is already attached to the class


        // Prepare the pivot data, conditionally include application_id if application exists
        $pivotData = [];
        if ($application) {
            $pivotData['application_id'] = $application->id;
            $application->delete();
        }

        // Attach the student to the class, with application_id if available
        if (isset($attributes['student_id'])) {
            $class->students()->attach($attributes['student_id'], $pivotData);
        } else {
            $class->students()->attach($student['id'], $pivotData);
        }

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit')) {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }
        if (Str::endsWith(url()->previous(), '?zmenit')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }

        return back()->with('success_cc', 'Úspešne pridané');
    }

    public function destroy(Student $student, CourseClass $class)
    {
        //     dd($coursetype);
        //     $attributes = request()->validate(
        //     [
        //         'coursetype_id' => ['nullable', Rule::exists('course_types', 'id')],
        //         'instructor_id' => ['nullable', Rule::exists('instructors','id')]
        //     ]
        // );
        // $instructor ? $instructor->coursetypes()->detach($attributes['coursetype_id']) : $coursetype->instructors()->detach($attributes['instructor_id']);
        $applicationId = $class->students()->where('student_id', $student->id)->first()->pivot->application_id ?? null;


        if ($applicationId) {
            $application = Application::withTrashed()->findOrFail($applicationId);
            $application->restore();
        }

        $class->students()->detach($student['id']);
        // if ($instructor){

        // }
        // else if ($coursetype){
        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit')) {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        if (Str::endsWith(url()->previous(), '?zmenit')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        // }
        return back()->with('success_dd', 'Úspešne vymazané');
    }
}

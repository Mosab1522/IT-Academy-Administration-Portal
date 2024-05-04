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
use Illuminate\Validation\ValidationException;

class Class_StudentController extends Controller
{
    public function store()
    {

        $attributes = request()->validateWithBag('admin',[
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'student_id' => ['required_without_all:name,lastname,email', 'integer', Rule::exists('students', 'id')],
            'name' => ['required_without:student_id', 'max:255'],
            'lastname' => ['required_without:student_id', 'max:255'],
            'email' => ['required_without:student_id', 'email', 'max:255'],
        ],$this->messages());
        $class = CourseClass::findOrFail($attributes['class_id']);
        if (isset($attributes['student_id'])) {
            if ($class->students()->where('student_id', $attributes['student_id'])->exists()) {
                throw ValidationException::withMessages(['name' => 'Tento študent je už v triede.' ,'lastname' => 'Tento študent je už v triede.','email' => 'Tento študent je už v triede.','class_id' => 'Tento študent je už v triede.'])->errorBag('admin');
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
            if(!$student)
            {
                throw ValidationException::withMessages(['email' => 'Neevidujeme študenta pod týmto emailom.'])->errorBag('admin');
            }
           
                if ($student['name'] != $attributes['name']) {
                    throw ValidationException::withMessages(['name' => 'Tento email vedieme v systéme pod iným menom.'])->errorBag('admin');
                }
                if ($student['lastname'] != $attributes['lastname']) {
                    throw ValidationException::withMessages(['lastname' => 'Tento email vedieme v systéme pod iným priezviskom.'])->errorBag('admin');
                }
            

            if ($class->students()->where('student_id', $student['id'])->exists()) {
                throw ValidationException::withMessages(['name' => 'Tento študent je už v triede.' ,'lastname' => 'Tento študent je už v triede.','email' => 'Tento študent je už v triede.'])->errorBag('admin');
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

    protected function messages(){
        return [
            'class_id.required' => 'Pole ID triedy je povinné.',
            'class_id.integer' => 'ID triedy musí byť celé číslo.',
            'class_id.exists' => 'Vybraná trieda neexistuje.',
            'student_id.required_without_all' => 'ID študenta je povinné, pokiaľ nie sú vyplnené polia meno, priezvisko a e-mail.',
            'student_id.integer' => 'ID študenta musí byť celé číslo.',
            'student_id.exists' => 'Vybraný študent neexistuje.',
            'name.required_without' => 'Meno je povinné.',
            'name.max' => 'Meno nemôže byť dlhšie ako 255 znakov.',
            'lastname.required_without' => 'Priezvisko je povinné.',
            'lastname.max' => 'Priezvisko nemôže byť dlhšie ako 255 znakov.',
            'email.required_without' => 'E-mail je povinný.',
            'email.email' => 'E-mail musí byť platná e-mailová adresa.',
            'email.max' => 'E-mail nemôže byť dlhší ako 255 znakov.',
        ];
    }
}

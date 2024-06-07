<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseClass;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use stdClass;
use Illuminate\Support\Facades\Gate;

class Class_StudentController extends Controller

{
    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            $authInstructorId = auth()->user()->user_id;
            $query = CourseClass::with(['academy', 'coursetype', 'students', 'instructor'])->where(function ($query) {
                $query->where('ended', true);
            })->whereHas('instructor', function ($query) use ($authInstructorId) {
                $query->where('id', $authInstructorId);
            });
        } else {
            $query = CourseClass::with(['academy', 'coursetype', 'students', 'instructor'])->where(function ($query) {
                $query->where('ended', true);
            });
        }

        if ($request->filled('search')) {
            $search = '%' . $request->input('search') . '%';
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhereHas('coursetype', function ($q) use ($search) {
                        $q->where('name', 'like', $search)
                            ->orWhereHas('academy', function ($subQuery) use ($search) {
                                $subQuery->where('name', 'like', $search);
                            });
                    })
                    ->orWhereHas('instructor', function ($q) use ($search) {
                        $q->where('name', 'like', $search)
                            ->orWhere('lastname', 'like', $search);
                    });
            });
        }

        if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
            $academyId = $request->input('academy_id');
            $coursetypeId = $request->input('coursetype_id');

            $query->whereHas('coursetype', function ($query) use ($academyId, $coursetypeId) {
                $query->where('id', $coursetypeId)
                    ->whereHas('academy', function ($subQuery) use ($academyId) {
                        $subQuery->where('id', $academyId);
                    });
            });
        } elseif ($request->filled('academy_id')) {
            $academyId = $request->input('academy_id');
            $query->whereHas('coursetype.academy', function ($query) use ($academyId) {
                $query->where('id', $academyId);
            });
        }

        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $query->orderBy($orderBy, $orderDirection);
        } else {
            $query->orderBy('updated_at', 'desc');
        }
        $query = $query->get();

        $classstudents = collect();

        foreach ($query as $class) {
            foreach ($class->students as $student) {

                if ($student->pivot->ended == 3) {
                    $structuredClass = new stdClass;
                    $structuredClass->class = new stdClass;

                    $structuredClass->class->id = $class->id;
                    $structuredClass->class->name = $class->name;
                    $structuredClass->class->coursetype_id = $class->coursetype->id ?? null;
                    $structuredClass->class->coursetype_name = $class->coursetype->name ?? null;
                    $structuredClass->class->coursetype_type = $class->coursetype->type ?? null;
                    $structuredClass->class->academy_name = $class->coursetype->academy->name ?? null;
                    $structuredClass->class->instructor_id = $class->instructor->id ?? null;
                    $structuredClass->class->instructor_name = $class->instructor->name ?? null;
                    $structuredClass->class->instructor_lastname = $class->instructor->lastname ?? null;

                    $structuredStudent = new stdClass;
                    $structuredStudent->id = $student->id;
                    $structuredStudent->name = $student->name;
                    $structuredStudent->lastname = $student->lastname;
                    $structuredStudent->application_id = $student->pivot->application_id;
                    $structuredStudent->ended = $student->pivot->ended;
                    $structuredStudent->pivot_created_at = $student->pivot->created_at->toDateTimeString();
                    $structuredStudent->pivot_updated_at = $student->pivot->updated_at->toDateTimeString();

                    $structuredClass->student = $structuredStudent;

                    $classstudents->push($structuredClass);
                }
            }
        }

        return view('admin.history-certificates', [
            'classstudents' => $classstudents
        ]);
    }

    public function store()
    {
        $attributes = request()->validateWithBag('admin', [
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'student_id' => ['required_without_all:name,lastname,email', 'integer', Rule::exists('students', 'id')],
            'name' => ['required_without:student_id', 'max:255'],
            'lastname' => ['required_without:student_id', 'max:255'],
            'email' => ['required_without:student_id', 'email', 'max:255'],
        ], $this->messages());
        $class = CourseClass::findOrFail($attributes['class_id']);
        if (isset($attributes['student_id'])) {
            if ($class->students()->where('student_id', $attributes['student_id'])->exists()) {
                throw ValidationException::withMessages(['name' => 'Tento študent je už v triede.', 'lastname' => 'Tento študent je už v triede.', 'email' => 'Tento študent je už v triede.', 'class_id' => 'Tento študent je už v triede.'])->errorBag('admin');
            }
            $application = Application::where('student_id', $attributes['student_id'])
                ->where('coursetype_id', $class->coursetype->id)
                ->first();
        } else {
            $student = Student::where(function ($query) use ($attributes) {
                $query->where('email', $attributes['email'])
                    ->orWhere('sekemail', $attributes['email']);
            })->first();
            if (!$student) {
                throw ValidationException::withMessages(['email' => 'Neevidujeme študenta pod týmto emailom.'])->errorBag('admin');
            }

            if ($student['name'] != $attributes['name']) {
                throw ValidationException::withMessages(['name' => 'Tento email vedieme v systéme pod iným menom.'])->errorBag('admin');
            }
            if ($student['lastname'] != $attributes['lastname']) {
                throw ValidationException::withMessages(['lastname' => 'Tento email vedieme v systéme pod iným priezviskom.'])->errorBag('admin');
            }

            if ($class->students()->where('student_id', $student['id'])->exists()) {
                throw ValidationException::withMessages(['name' => 'Tento študent je už v triede.', 'lastname' => 'Tento študent je už v triede.', 'email' => 'Tento študent je už v triede.'])->errorBag('admin');
            }
            $application = Application::where('student_id', $student['id'])
                ->where('coursetype_id', $class->coursetype->id)
                ->first();
        }

        $pivotData = [];
        if ($application) {
            $pivotData['application_id'] = $application->id;
            $application->delete();
        }
        $pivotData['ended'] = 1;

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
        $applicationId = $class->students()->where('student_id', $student->id)->first()->pivot->application_id ?? null;


        if ($applicationId) {
            $application = Application::withTrashed()->findOrFail($applicationId);
            $application->restore();
        }

        $class->students()->detach($student['id']);

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
        return back()->with('success_dd', 'Úspešne vymazané');
    }

    protected function messages()
    {
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

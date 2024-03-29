<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseClass;
use App\Models\CourseType;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CourseClassController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $classes = CourseClass::with(['academy', 'coursetype', 'students'])->where('name', 'like', '%' . $request->input('search') . '%')
                ->orwhereHas('academy', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                })->orwhereHas('coursetype', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
        } else {
            $classes = CourseClass::with(['academy', 'coursetype', 'students']);
        }

        // dd($request->input('search'));
        // spracovanie filtrov
        if ($request->filled('academy_id')) {
            $filter = $request->input('academy_id');
            $classes->where('academy_id', $filter);
        }

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $classes->orderBy($orderBy, $orderDirection);
        } else {
            $classes->orderBy('created_at', 'desc');
        }

        $classes = $classes->get();

        return view('admin.classes-index', [
            'classes' => $classes
        ]);
    }

    public function show(CourseClass $class)
    {
        return view('admin.classes-show', ['class' => $class]);
    }

    public function create()
    {
        return view('admin.classes-create');
    }

    public function store()
    {

        $attributes = request()->validate([
            'students' => ['in:on'],
            'name' => ['required', 'max:255', Rule::unique('course_classes', 'name')],
            'type' => ['required', 'integer', 'in:0,1,2'],
            'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
            'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
            'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
            'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
            'days' => ['required', 'integer', 'in:1,2,3'],
            'time' => ['required', 'integer', 'in:1,2,3']
        ]);

        if ($attributes['type'] == 0) {
            $attributes['academy_id'] = $attributes['academy_id2'];
            $attributes['coursetype_id'] = $attributes['coursetype_id2'];
        }


        $class = CourseClass::create([
            'name' => $attributes['name'],
            'academy_id' => $attributes['academy_id'],
            'coursetype_id' => $attributes['coursetype_id'],
            'days' => $attributes['days'],
            'time' => $attributes['time']
        ]);

        if (isset($attributes['students'])) {
            $applications = CourseType::find($attributes['coursetype_id'])->applications;

            foreach ($applications as $application) {
                // Assuming Application model has a 'student' relationship defined
                $student = $application->student;

                // Check if the student is not already in the class
                if (!$class->students->contains($student->id)) {
                    // Attach the student to the class
                    $class->students()->attach($student->id, ['application_id' => $application->id]);
                    // Optionally, you might want to mark the application as processed or remove it
                }
                $application->delete();
            }
        }

        $instructors = CourseType::find($attributes['coursetype_id'])->instructors;
        if ($instructors) {
            foreach ($instructors as $instructor) {
                $class->instructors()->save($instructor);
            }
        }


        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }

        return back()->with('success_c', 'Úspešne vytvorené');
    }

    public function update(CourseClass $class)
    {

        // $academy = Academy::with(['class', 'applications'])
        // ->where('id', '=', request()->academy_id)->first();

        // if ($academy == null) {
        //     dd(request()->all());
        // };

        // request()->merge(['academy_id'  => $academy['id']]); 

        //    if(request()->cname)
        //    {
        //     request()->merge(['name'  => request()->cname]);
        //    }


        $attributes = request()->validate([
            'name' => ['required', 'max:255', Rule::unique('course_classes', 'name')->ignore($class)],
            'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
            'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
            'min' => ['required', 'integer', 'lte:max'],
            'max' => ['required', 'integer', 'gte:min'],
        ]);

        $class->update($attributes);

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit')) {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }

        return back()->with('success_u', 'Úspešne aktualizované');
    }

    public function destroy(CourseClass $class)
    {
        if ($class->students->count() > 0) {
            
            foreach ($class->students as $student) {
                // Access application_id from the pivot table
                $applicationId = $student->pivot->application_id ?? null;
                
                if ($applicationId) {
                    // Try to restore the application
                    $application = Application::withTrashed()->find($applicationId);
                    if ($application) {
                        $application->restore();
                        // Additional logic here, if needed
                    }
                }
            }
        }

        $class->delete();

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }

        return back()->with('success_d', 'Úspešne vymazané');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseClass;
use App\Models\Lesson;
use App\Models\CourseType;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $lessons = Lesson::with(['class', 'instructor'])->where('name', 'like', '%' . $request->input('search') . '%')
                ->orwhereHas('class', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                })->orwhereHas('instructor', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
        } else {
            $lessons = Lesson::with(['class', 'instructor']);
        }

        // dd($request->input('search'));
        // spracovanie filtrov
        if ($request->filled('class_id')) {
            $filter = $request->input('class_id');
            $lessons->where('class_id', $filter);
        }

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $lessons->orderBy($orderBy, $orderDirection);
        } else {
            $lessons->orderBy('created_at', 'desc');
        }

        $lessons = $lessons->get();

        return view('admin.lessons-index', [
            'lessons' => $lessons
        ]);
    }

    public function show(Lesson $lesson)
    {
        return view('admin.lessons-show', ['lesson' => $lesson]);
    }

    public function create()
    {
        return view('admin.lessons-create');
    }

    public function store()
    {
        $attributes = request()->validate([
           // 'students' => ['in:on'],
            'title' => ['required', 'max:255', Rule::unique('lessons', 'title')],
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id' )],
            'lesson_date' => ['required', 'date']
        ]);

        foreach($attributes['instructor_id'] = CourseClass::find($attributes['class_id'])->instructors as $instructor)
        {
            $attributes['instructor_id'] = $instructor->id;
        }
        
        $lesson = Lesson::create($attributes);

        // if (isset($attributes['students'])) {
        //     $applications = CourseType::find($attributes['coursetype_id'])->applications;

        //     foreach ($applications as $application) {
        //         // Assuming Application model has a 'student' relationship defined
        //         $student = $application->student;

        //         // Check if the student is not already in the class
        //         if (!$class->students->contains($student->id)) {
        //             // Attach the student to the class
        //             $class->students()->attach($student->id, ['application_id' => $application->id]);
        //             // Optionally, you might want to mark the application as processed or remove it
        //         }
        //         $application->delete();
        //     }
        // }

        // $instructors = CourseType::find($attributes['coursetype_id'])->instructors;
        // if ($instructors) {
        //     foreach ($instructors as $instructor) {
        //         $class->instructors()->save($instructor);
        //     }
        // }


        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }

        return back()->with('success_c', 'Úspešne vytvorené');
    }

    public function update(Lesson $lesson)
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
            'title' => ['required', 'max:255', Rule::unique('lessons', 'title')->ignore($lesson)],
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'instructor_id' => ['required', 'integer', Rule::exists('instructors', 'id')],
            'lesson_date' => ['required', 'date']
        ]);

        $lesson->update($attributes);

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

    public function destroy(Lesson $lesson)
    {

        $lesson->delete();

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }

        return back()->with('success_d', 'Úspešne vymazané');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseClass;
use App\Models\Lesson;
use App\Models\CourseType;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $lessons = Lesson::with(['class', 'instructor']);

        // Apply a generic search across multiple related models
        if ($request->filled('search')) {
            $search = '%' . $request->input('search') . '%';
            $lessons->where(function ($query) use ($search) {
                $query->where('title', 'like', $search)
                      ->orWhereHas('class', function ($subQuery) use ($search) {
                          $subQuery->where('name', 'like', $search);
                      })
                      ->orWhereHas('instructor', function ($subQuery) use ($search) {
                          $subQuery->where('name', 'like', $search);
                      });
            });
        }
    
        // Filter by class_id if provided
        if ($request->filled('class_id')) {
            $lessons->where('class_id', $request->input('class_id'));
        }

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $lessons->orderBy($orderBy, $orderDirection);
        } else {
            $lessons->orderBy('lesson_date', 'desc');
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
            'title' => ['required', 'max:255'],
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id' )],
            'lesson_date' => ['required', 'date'],
            'duration' => 'required|date_format:H:i'
        ],$this->messages());

        list($hours, $minutes) = explode(':', $attributes['duration']);

        // Convert hours to minutes and add to minutes
        $totalMinutes = ($hours * 60) + $minutes;

        $attributes['duration'] = $totalMinutes;

        $attributes['instructor_id'] = CourseClass::find($attributes['class_id'])->instructor->id;
        
        
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

        $attributes = request()->validateWithBag('updateLesson',[
            'title' => ['required', 'max:255'],
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'instructor_id' => ['required', 'integer', Rule::exists('instructors', 'id')],
            'lesson_date' => ['required', 'date'],
            'duration' => 'required|date_format:H:i'
        ],$this->messages());

        list($hours, $minutes) = explode(':', $attributes['duration']);

        // Convert hours to minutes and add to minutes
        $totalMinutes = ($hours * 60) + $minutes;

        $attributes['duration'] = $totalMinutes;

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

    public function all(Request $request)
{
    $lessons = Lesson::query()
        ->with(['instructor', 'class.coursetype.academy'])
        ->when($request->academy_id, function ($query, $academyId) {
            $query->whereHas('class.coursetype.academy', function ($q) use ($academyId) {
                $q->where('id', $academyId);
            });
        })
        ->when($request->coursetype_id, function ($query, $coursetypeId) {
            $query->whereHas('class.coursetype', function ($q) use ($coursetypeId) {
                $q->where('id', $coursetypeId);
            });
        })
        ->when($request->class_id, function ($query, $classId) {
            $query->whereHas('class', function ($q) use ($classId) {
                $q->where('id', $classId);
            });
        })
        ->when($request->instructor_id, function ($query, $instructorId) {
            $query->whereHas('instructor', function ($q) use ($instructorId) {
                $q->where('id', $instructorId);
            });
        })
        ->get(); // Assuming each lesson has an 'instructor' relationship

    // Transform lessons into the required format for your calendar or application front-end.
    $formattedLessons = $lessons->map(function ($lesson) {
        $startTime = Carbon::parse($lesson->lesson_date);
        $endTime = $startTime->copy()->addMinutes($lesson->duration);
        return [
            'title' => $lesson->class->name,
            'start' => $startTime->format('Y-m-d H:i:s'),
            'end' => $endTime->toDateTimeString(),
        ];
    });
    return response()->json($formattedLessons);
}
protected function messages()
{
    return  [
        'title.required' => 'Názov je povinný.',
        'title.max' => 'Názov nemôže byť dlhší ako 255 znakov.',
        'class_id.required' => 'Trieda je povinná.',
        'class_id.integer' => 'ID triedy musí byť celé číslo.',
        'class_id.exists' => 'Vybraná trieda neexistuje.',
        'instructor_id.required' => 'Inštruktor je povinný.',
        'instructor_id.integer' => 'ID inštruktora musí byť celé číslo.',
        'instructor_id.exists' => 'Vybraný inštruktor neexistuje.',
        'lesson_date.required' => 'Dátum lekcie je povinný.',
        'lesson_date.date' => 'Dátum lekcie musí byť platný dátum.',
        'duration.required' => 'Trvanie je povinné.',
        'duration.date_format' => 'Formát trvania musí byť HH:mm.',
    ];
}
    

}

<?php

namespace App\Http\Controllers;

use App\Mail\LessonMail;
use App\Models\CourseClass;
use App\Models\Lesson;
use App\Models\Instructor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            $authInstructorId = auth()->user()->user_id;
            $lessons = Lesson::with(['class', 'instructor'])
                ->whereHas('class', function ($query) {
                    $query->where('ended', false);
                })->whereHas('instructor', function ($query) use ($authInstructorId) {
                    $query->where('id', $authInstructorId);
                });
        } else {
            $lessons = Lesson::with(['class', 'instructor'])
                ->whereHas('class', function ($query) {
                    $query->where('ended', false);
                });
        }

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

        if ($request->filled('class_id')) {
            $lessons->where('class_id', $request->input('class_id'));
        }

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
        if (auth()->user()->user_id != $lesson->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return view('admin.lessons-show', ['lesson' => $lesson]);
    }

    public function create()
    {
        return view('admin.lessons-create');
    }

    public function store()
    {
        if (request()->cemail && request()->cemail != '') {
            request()->merge(['email'  => request()->cemail]);
        }
        $attributes = request()->validate([

            'title' => ['required', 'max:255'],
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'lesson_date' => ['required', 'date'],
            'duration' => 'required|date_format:H:i',
            'email' => ['in:on'],
            'lessonType' => ['nullable', 'in:1,2'],
            'onsite' => ['nullable', 'string', 'max:30'],
            'online' => 'nullable|url',
        ], $this->messages());

        if (Gate::denies('admin')) {
            $class = CourseClass::find($attributes['class_id']);
            if (auth()->user()->user_id != $class->instructor_id) {
                abort(Response::HTTP_FORBIDDEN);
            }
        }

        list($hours, $minutes) = explode(':', $attributes['duration']);

        $totalMinutes = ($hours * 60) + $minutes;

        $attributes['duration'] = $totalMinutes;

        $attributes['instructor_id'] = CourseClass::find($attributes['class_id'])->instructor->id;

        $lesson = Lesson::create([
            'title' => $attributes['title'],
            'class_id' => $attributes['class_id'],
            'lesson_date' => $attributes['lesson_date'],
            'duration' => $attributes['duration'],
            'instructor_id' => $attributes['instructor_id']
        ]);

        if (isset($attributes['email'])) {
            if ($attributes['email'] == 'on') {
                $instructor = Instructor::firstWhere('id', $attributes['instructor_id']);
                $class = CourseClass::firstWhere('id', $attributes['class_id']);
                $emailData = ['classname' => $class->name, 'date' => $lesson->lesson_date, 'coursename' => $class->coursetype->name, 'title' => $lesson->title, 'time' => $lesson->duration, 'instructor_name' => $instructor->name, 'instructor_lastname' => $instructor->lastname];
                if (isset($attributes['lessonType'])) {
                    $emailData['lessonType'] = $attributes['lessonType'];
                    if ($attributes['lessonType'] == '1') {
                        if (isset($attributes['online'])) {
                            $emailData['where'] = $attributes['online'];
                        } else {
                            $emailData['where'] = false;
                        }
                    }
                    if ($attributes['lessonType'] == '2') {
                        if (isset($attributes['onsite'])) {
                            $emailData['where'] = $attributes['onsite'];
                        } else {
                            $emailData['where'] = false;
                        }
                    }
                } else {
                    $emailData['lessonType'] = false;
                }

                foreach ($class->students as $student) {
                    $emailData['name'] = $student->name;
                    $emailData['lastname'] = $student->lastname;
                    Mail::to($student->email)->send(new LessonMail($emailData));
                }
            }
        }

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }

        return back()->with('success_c', 'Úspešne vytvorené');
    }

    public function update(Lesson $lesson)
    {
        if (auth()->user()->user_id != $lesson->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $attributes = request()->validateWithBag('updateLesson', [
            'title' => ['required', 'max:255'],
            'class_id' => ['required', 'integer', Rule::exists('course_classes', 'id')],
            'instructor_id' => ['required', 'integer', Rule::exists('instructors', 'id')],
            'lesson_date' => ['required', 'date'],
            'duration' => 'required|date_format:H:i'
        ], $this->messages());

        list($hours, $minutes) = explode(':', $attributes['duration']);

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
        if (auth()->user()->user_id != $lesson->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $lesson->delete();

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }

        return back()->with('success_d', 'Úspešne vymazané');
    }


    public function all(Request $request)
    {
        if (Gate::denies('admin')) {
            if (isset($request->instructor_id)) {
                if ($request->instructor_id != auth()->user()->user_id) {
                    abort(Response::HTTP_FORBIDDEN);
                }
            } else {
                abort(Response::HTTP_FORBIDDEN);
            }
        }

        $lessons = Lesson::query()
            ->with(['instructor', 'class.coursetype.academy', 'class.students'])
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
            ->when($request->student_id, function ($query, $studentId) {
                $query->whereHas('class.students', function ($q) use ($studentId) {
                    $q->where('students.id', $studentId);
                });
            })
            ->get();

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
            'email.in' => 'Pole :attribute musí byť zapnuté.',
            'lessonType.in' => 'Pole :attribute musí byť jedna z hodnôt: 1, 2.',
            'onsite.string' => 'Pole :attribute musí byť reťazec.',
            'onsite.max' => 'Pole :attribute môže mať maximálne :max znakov.',
            'online.url' => 'Pole :attribute musí byť platná URL adresa.',
        ];
    }
}

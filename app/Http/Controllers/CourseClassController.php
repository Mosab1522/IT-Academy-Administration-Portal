<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseClass;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class CourseClassController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            $authInstructorId = auth()->user()->user_id;
            $classes = CourseClass::with(['academy', 'coursetype', 'students', 'instructor'])
                ->where(function ($query) {
                    $query->where('ended', false);
                })->whereHas('instructor', function ($query) use ($authInstructorId) {
                    $query->where('id', $authInstructorId);
                });
        } else {
            $classes = CourseClass::with(['academy', 'coursetype', 'students', 'instructor'])->where(function ($query) {
                $query->where('ended', false);
            });
        }

        if ($request->filled('search')) {
            $search = '%' . $request->input('search') . '%';
            $classes->where(function ($query) use ($search) {
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

            $classes->whereHas('coursetype', function ($query) use ($academyId, $coursetypeId) {
                $query->where('id', $coursetypeId)
                    ->whereHas('academy', function ($subQuery) use ($academyId) {
                        $subQuery->where('id', $academyId);
                    });
            });
        } elseif ($request->filled('academy_id')) {
            $academyId = $request->input('academy_id');
            $classes->whereHas('coursetype.academy', function ($query) use ($academyId) {
                $query->where('id', $academyId);
            });
        }

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
        if (auth()->user()->user_id != $class->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }
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
            'instructor_id' => ['nullable', 'integer', Rule::exists('instructors', 'id')],
            'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
            'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
            'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
            'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
            'days' => ['required', 'integer', 'in:1,2,3'],
            'time' => ['required', 'integer', 'in:1,2,3']
        ], $this->messages());

        if (Gate::denies('admin')) {
            if (isset(request()->instructor_id)) {
                if (request()->instructor_id != auth()->user()->user_id) {
                    abort(Response::HTTP_FORBIDDEN);
                }
            } else {
                abort(Response::HTTP_FORBIDDEN);
            }
            if ($attributes['type'] == 0) {
                $attributes['academy_id'] = $attributes['academy_id2'];
                $attributes['coursetype_id'] = $attributes['coursetype_id2'];
            }
        }

        if (isset($attributes['instructor_id'])) {
            $class = CourseClass::create([
                'name' => $attributes['name'],
                'academy_id' => $attributes['academy_id'],
                'coursetype_id' => $attributes['coursetype_id'],
                'instructor_id' => $attributes['instructor_id'],
                'days' => $attributes['days'],
                'time' => $attributes['time']
            ]);
            if (isset($attributes['students'])) {
                $applications = CourseType::find($attributes['coursetype_id'])->applications;

                foreach ($applications as $application) {
                    $student = $application->student;

                    if (!$class->students->contains($student->id)) {
                        $class->students()->attach($student->id, ['application_id' => $application->id]);
                    }
                    $application->delete();
                }
            }
            if (Str::endsWith(url()->previous(), '?pridat')) {
                $trimmedUrl = substr(url()->previous(), 0, -7);
                return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
            }

            return back()->with('success_c', 'Úspešne vytvorené');
        }

        if ($attributes['type'] == 0) {
            $attributes['academy_id'] = $attributes['academy_id2'];
            $attributes['coursetype_id'] = $attributes['coursetype_id2'];
        }

        $coursetype = CourseType::with('instructors')->findOrFail($attributes['coursetype_id']);

        if ($coursetype->instructors->isEmpty()) {
            $field = $attributes['type'] == 1 ? 'coursetype_id' : 'coursetype_id2';
            throw ValidationException::withMessages([$field => 'Kurz musí mať priradeného aspoň jedného inštruktora na vytvorenie triedy.']);
        }

        if ($coursetype->instructors->count() > 1) {
            session([
                'class_attributes' => $attributes,
                'coursetype_id' => $attributes['coursetype_id']
            ]);

            return redirect()->route('classes.instructor.select');
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
                $student = $application->student;

                if (!$class->students->contains($student->id)) {
                    $class->students()->attach($student->id, ['application_id' => $application->id, 'ended' => '1']);
                }
                $application->delete();
            }
        }

        if ($coursetype->instructors->count() == 1) {
            $class->update(['instructor_id' => $coursetype->instructors[0]['id']]);
        }

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }

        return back()->with('success_c', 'Úspešne vytvorené');
    }

    public function update(CourseClass $class)
    {
        if (auth()->user()->user_id != $class->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if (request()->cname) {
            request()->merge(['name'  => request()->cname]);
        }

        $attributes = request()->validateWithBag('updateClass', [
            'name' => ['required', 'max:255', Rule::unique('course_classes', 'name')->ignore($class)],
            'days' => ['required', 'integer', 'in:1,2,3'],
            'time' => ['required', 'integer', 'in:1,2,3']
        ], $this->messages());

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
        if (auth()->user()->user_id != $class->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($class->students->count() > 0) {

            foreach ($class->students as $student) {
                $applicationId = $student->pivot->application_id ?? null;

                if ($applicationId) {
                    $application = Application::withTrashed()->find($applicationId);
                    if ($application) {
                        $application->restore();
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

    public function end(CourseClass $class)
    {
        if (auth()->user()->user_id != $class->instructor_id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $attributes = request()->validateWithBag('endClass', [
            'students' => ['array'],
            'students.*' => 'distinct|exists:students,id',

        ], $this->messages());

        $class->update(['ended' => true]);

        $studentIds = collect(data_get($attributes, 'students', []));

        foreach ($class->students as $student) {

            if (!$studentIds->contains($student->id)) {
                $class->students()->updateExistingPivot($student->id, ['ended' => '2']);
            } else {
                $class->students()->updateExistingPivot($student->id, ['ended' => '3']);
            }
        }

        return redirect('/admin/history/classes')->with('success_end', 'Úspešne ukončnená trieda');
    }

    protected function messages()
    {
        return [
            'name.required' => 'Názov je povinný.',
            'name.max' => 'Názov môže mať maximálne :max znakov.',
            'name.unique' => 'Názov už existuje.',
            'type.required' => 'Typ je povinný.',
            'type.integer' => 'Typ musí byť celé číslo.',
            'type.in' => 'Typ musí byť jedno z: :values.',
            'academy_id.required_if' => 'Akadémia je povinná, keď je typ inštruktorský.',
            'academy_id.integer' => 'Akadémia musí byť celé číslo.',
            'academy_id.exists' => 'Vybraná akadémia neexistuje.',
            'coursetype_id.required_if' => 'Typ kurzu je povinný, keď je typ inštruktorský.',
            'coursetype_id.integer' => 'Typ kurzu musí byť celé číslo.',
            'coursetype_id.exists' => 'Vybraný typ kurzu neexistuje.',
            'academy_id2.required_if' => 'Akadémia je povinná, keď je typ študentský.',
            'academy_id2.integer' => 'Akadémia musí byť celé číslo.',
            'academy_id2.exists' => 'Vybraná akadémia neexistuje.',
            'coursetype_id2.required_if' => 'Typ kurzu je povinný, keď je typ študentský.',
            'coursetype_id2.integer' => 'Typ kurzu musí byť celé číslo.',
            'coursetype_id2.exists' => 'Vybraný typ kurzu neexistuje.',
            'days.required' => 'Dni sú povinné.',
            'days.integer' => 'Dni musia byť celé číslo.',
            'days.in' => 'Dni musia byť jedno z: :values.',
            'time.required' => 'Čas je povinný.',
            'time.integer' => 'Čas musí byť celé číslo.',
            'time.in' => 'Čas musí byť jedno z: :values.'
        ];
    }

    public function selectInstructor()
    {
        $classAttributes = session('class_attributes');
        $coursetypeId = session('coursetype_id');

        session()->forget('class_attributes', 'coursetype_id');
        $instructors = CourseType::with('instructors')->findOrFail($coursetypeId)->instructors;

        return view('admin.classes-create', compact('instructors', 'classAttributes'));
    }
    public function history(Request $request)
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

        $classes = $query->get();

        return view('admin.history-classes', [
            'classes' => $classes
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class CourseTypeController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            $authInstructorId = auth()->user()->user_id;
            $coursetypes = \App\Models\CourseType::with(['academy', 'applications', 'instructors', 'classes'])->whereHas('instructors', function ($query) use ($authInstructorId) {
                $query->where('instructors.id', $authInstructorId);
            });
        } else {
            $coursetypes = CourseType::with(['academy', 'applications', 'instructors', 'classes']);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $coursetypes->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('academy', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('academy_id')) {
            $coursetypes->where('academy_id', $request->input('academy_id'));
        }

        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $coursetypes->orderBy($orderBy, $orderDirection);
        } else {
            $coursetypes->orderBy('name', 'asc');
        }

        $coursetypes = $coursetypes->get();

        return view('admin.coursetypes-index', [
            'coursetypes' => $coursetypes
        ]);
    }

    public function show(Coursetype $coursetype)
    {
        if ((!$coursetype->instructors->contains('id', auth()->user()->user_id)) && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('admin.coursetypes-show', ['coursetype' => $coursetype]);
    }

    public function create()
    {
        return view('admin.coursetypes-create');
    }

    public function store()
    {
        $validation = $this->messages();
        if (request()->type == 2) {
            $attributes = request()->validate([
                'name' => 'required|max:255|unique:course_types,name,NULL,id,type,0',
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'type' => ['required', 'integer', 'in:0,1,2'],
                'min' => ['required', 'integer', 'lte:max'],
                'max' => ['required', 'integer', 'gte:min'],
            ], $validation['messages']);
            $attributes = request()->validate([
                'name' => 'required|max:255|unique:course_types,name,NULL,id,type,1',
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'type' => ['required', 'integer', 'in:0,1,2'],
                'min' => ['required', 'integer', 'lte:max'],
                'max' => ['required', 'integer', 'gte:min'],
            ], $validation['messages']);
            $attributes['type'] = 0;
            CourseType::create($attributes);
            $attributes['type'] = 1;
            CourseType::create($attributes);
        } else {
            $attributes = request()->validate([
                'name' => 'required|max:255|unique:course_types,name,NULL,id,type,' . request()->type,
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'type' => ['required', 'integer', 'in:0,1,2'],
                'min' => ['required', 'integer', 'lte:max'],
                'max' => ['required', 'integer', 'gte:min'],
            ], $validation['messages']);
            CourseType::create($attributes);
        }


        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }

        return back()->with('success_c', 'Úspešne vytvorené');
    }
    public function update(Coursetype $coursetype)
    {
        if ((!$coursetype->instructors->contains('id', auth()->user()->user_id)) && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if (request()->cname) {
            request()->merge(['name'  => request()->cname]);
        }

        $validation = $this->messages();

        $attributes = request()->validateWithBag('updateCoursetype', [
            'name' => 'required|max:255|unique:course_types,name,' . $coursetype->id . ',id,type,' . request()->type,
            'type' => ['required', 'integer', 'in:0,1'],
            'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
            'min' => ['required', 'integer', 'lte:max'],
            'max' => ['required', 'integer', 'gte:min'],
        ], $validation['messages']);

        $coursetype->update($attributes);

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

    public function destroy(CourseType $coursetype)
    {

        $coursetype->delete();

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }

        return back()->with('success_dd', 'Úspešne vymazané');
    }

    protected function messages()
    {
        return [
            'messages' => [
                'name.required' => 'Názov je povinný.',
                'name.max' => 'Názov kurzu nesmie mať viac ako 255 znakov.',
                'name.unique' => 'Tento názov kurzu už existuje s týmto typom kurzu.',
                'academy_id.required' => 'Vyberte akadémiu.',
                'academy_id.integer' => 'ID akadémie musí byť číslo.',
                'academy_id.exists' => 'Zadaná akadémia neexistuje.',
                'type.required' => 'Typ kurzu je povinný.',
                'type.integer' => 'Typ kurzu musí byť číselného typu.',
                'type.in' => 'Neplatný typ kurzu. Povolené hodnoty sú študentský, inštruktorský alebo obidva.',
                'min.required' => 'Minimálny počet študentov je povinný.',
                'min.integer' => 'Minimálny počet študentov musí byť číslo.',
                'min.lte' => 'Minimálny počet študentov musí byť menší alebo rovný maximálnemu počtu.',
                'max.required' => 'Maximálny počet študentov je povinný.',
                'max.integer' => 'Maximálny počet študentov musí byť číslo.',
                'max.gte' => 'Maximálny počet študentov musí byť väčší alebo rovný minimálnemu počtu.'
            ]
        ];
    }
}

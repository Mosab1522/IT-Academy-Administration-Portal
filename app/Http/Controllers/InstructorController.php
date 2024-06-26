<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;


class InstructorController extends Controller
{
    public function index(Request $request)
    {
        $instructors = Instructor::with(['coursetypes', 'login']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $instructors->where(function ($query) use ($searchTerm) {
                $query->where('instructors.name', 'like', $searchTerm)
                    ->orWhere('instructors.lastname', 'like', $searchTerm)
                    ->orWhere('instructors.email', 'like', $searchTerm);
            });
        }

        if ($request->filled('academy_id')) {
            $academyId = $request->input('academy_id');
            $coursetypeId = $request->input('coursetype_id', null);

            $instructors->whereHas('coursetypes', function ($query) use ($academyId, $coursetypeId) {
                $query->whereHas('academy', function ($subQuery) use ($academyId) {
                    $subQuery->where('academies.id', '=', $academyId); // Explicitly reference academies.id
                });

                if (!is_null($coursetypeId)) {
                    $query->where('course_types.id', '=', $coursetypeId); // Explicitly reference course_types.id
                }
            });
        }

        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $instructors->orderBy($orderBy, $orderDirection);
        } else {
            $instructors->orderBy('created_at', 'desc');
        }

        $instructors = $instructors->get();

        return view('admin.instructors-index', [
            'instructors' => $instructors
        ]);
    }
    public function show(Instructor $instructor)
    {
        if (auth()->user()->user_id != $instructor->id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('admin.instructors-show', ['instructor' => $instructor]);
    }

    public function create()
    {
        return view('admin.instructors-create');
    }

    public function store()
    {

        if (request()->cemail && request()->cemail != '') {
            request()->merge(['email'  => request()->cemail]);
        }
        if (request()->csekemail && request()->csekemail != '') {
            request()->merge(['sekemail'  => request()->csekemail]);
        }

        $attributes = request()->validate(
            [
                'name' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255'],
                'photo' => ['image'],
                'email' => ['required', 'email', 'different:sekemail', 'max:255', Rule::unique('instructors', 'email'), Rule::unique('instructors', 'sekemail')],
                'sekemail' => ['email', 'nullable', 'different:email', Rule::unique('instructors', 'email'), Rule::unique('instructors', 'sekemail')],
                'telephone' => [
                    'nullable',
                    'regex:/^\+421\s?9\d{2}\s?\d{3}\s?\d{3}$|^09\d{2}\s?\d{3}\s?\d{3}$/',
                ],
                'ulicacislo' => ['nullable', 'required_with:mestoobec,psc', 'min:3', 'max:255'],
                'mestoobec' => ['nullable', 'required_with:ulicacislo,psc', 'min:1', 'max:255'],
                'psc' => ['nullable', 'required_with:mestoobec,ulicacislo', 'min:6', 'max:6'],

                'coursetypes_id' => ['array',],
                'coursetypes_id.*' => 'nullable|distinct|exists:course_types,id'
            ],
            $this->messages()
        );

        if (empty($attributes['telephone'])) {
            $attributes['telephone'] = NULL;
        } else {

            $attributes['telephone'] = $this->normalizePhoneNumber(request()->telephone);

            $rule = array('telephone' => [Rule::unique('instructors', 'telephone')]);
            $validation = Validator($attributes, $rule);

            if ($validation->fails()) {
                throw ValidationException::withMessages(['telephone' => 'Toto telefonné číslo sa už používa.']);
            }
        }

        $attributes['photo'] ??= null;
        if ($attributes['photo']) {
            $attributes['photo'] = request()->file('photo')->store('photos');
        } else {
            $attributes['photo'] = 'photos/basic.jpg';
        }

        $instructor = Instructor::create([
            'name' => $attributes['name'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email'],
            'sekemail' => $attributes['sekemail'],
            'photo' => $attributes['photo'],
            'telephone' => $attributes['telephone'],
            'ulicacislo' => $attributes['ulicacislo'],
            'mestoobec' => $attributes['mestoobec'],
            'psc' => $attributes['psc']
        ]);
        if (request()->coursetypes_id) {
            foreach (request()->coursetypes_id as $coursetype_id) {
                if ($coursetype_id != 0) {
                    $coursetype = CourseType::find($coursetype_id);
                    $instructor->coursetypes()->save($coursetype);
                }
            }
        }

        session(['instructor_id' => $instructor['id']]);

        return redirect('/admin/login/' . $instructor['id'])->with('success_c', 'Úspešne vytvorené');
    }

    public function update(Instructor $instructor)
    {
        if (auth()->user()->user_id != $instructor->id && Gate::denies('admin')) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if (request()->photo) {
            $attributes = request()->validateWithBag(
                'Photo',
                [
                    'photo' => ['image']
                ],
                $this->messages()
            );
            $attributes['photo'] = request()->file('photo')->store('photos');
            $instructor->update($attributes);
            return back()->with('success_u', 'Úspešne aktualizované');
        }

        $attributes = request()->validateWithBag(
            'updateInstructor',
            [
                'name' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255'],

                'email' => ['required', 'email', 'max:255', Rule::unique('instructors', 'email')->ignore($instructor), Rule::unique('instructors', 'sekemail')->ignore($instructor)],
                'sekemail' => ['nullable', 'email', 'different:email', Rule::unique('instructors', 'email')->ignore($instructor), Rule::unique('instructors', 'sekemail')->ignore($instructor)],
                'telephone' => [
                    'nullable',
                    'regex:/^\+421\s?9\d{2}\s?\d{3}\s?\d{3}$|^09\d{2}\s?\d{3}\s?\d{3}$/'
                ],
                'ulicacislo' => ['nullable', 'required_with:mestoobec,psc', 'min:3', 'max:255'],
                'mestoobec' => ['nullable', 'required_with:ulicacislo,psc', 'min:1', 'max:255'],
                'psc' => ['nullable', 'required_with:mestoobec,ulicacislo', 'min:6', 'max:6'],
            ],
            $this->messages()
        );


        if (empty($attributes['telephone'])) {
            $attributes['telephone'] = NULL;
        } else {
            $attributes['telephone'] = $this->normalizePhoneNumber(request()->telephone);

            $rule = array('telephone' => [Rule::unique('instructors', 'telephone')->ignore($instructor)]);
            $validation = Validator($attributes, $rule);

            if ($validation->fails()) {
                throw ValidationException::withMessages(['telephone' => 'Toto telefonné číslo sa už používa.'])->errorBag('updateInstructor');
            }
        }

        $attributes['photo'] = $instructor['photo'];

        $instructor->update($attributes);

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit')) {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }
        if (Str::endsWith(url()->previous(), '?zmenit')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }

        return back()->with('success_u', 'Úspešne aktualizované');
    }

    public function destroy(Instructor $instructor)
    {

        $instructor->delete();

        return back()->with('success_d', 'Úspešne vymazané');
    }

    protected function normalizePhoneNumber($phoneNumber)
    {

        $normalizedNumber = str_replace(' ', '', $phoneNumber);

        if (strpos($normalizedNumber, '0') === 0) {
            $normalizedNumber = '+421' . substr($normalizedNumber, 1);
        }

        return $normalizedNumber;
    }

    protected function messages()
    {
        return [
            'name.required' => 'Meno je povinné.',
            'name.max' => 'Meno môže mať maximálne 255 znakov.',
            'lastname.required' => 'Priezvisko je povinné.',
            'lastname.max' => 'Priezvisko môže mať maximálne 255 znakov.',
            'photo.image' => 'Súbor musí byť obrázok.',
            'email.required' => 'Pole e-mail je povinné.',
            'email.email' => 'E-mail musí byť platná e-mailová adresa.',
            'email.different' => 'E-mail musí byť odlišný od sekundárneho e-mailu.',
            'email.max' => 'E-mail môže mať maximálne 255 znakov.',
            'email.unique' => 'Tento e-mail už je zaregistrovaný.',
            'sekemail.email' => 'Sekundárny e-mail musí byť platná e-mailová adresa.',
            'sekemail.different' => 'Sekundárny e-mail musí byť odlišný od hlavného e-mailu.',
            'sekemail.unique' => 'Tento sekundárny e-mail už je zaregistrovaný.',
            'telephone.regex' => 'Telefónne číslo musí byť v správnom formáte.',
            'ulicacislo.required_with' => 'Ulica a číslo sú povinné, ak je zadané mesto alebo PSČ.',
            'ulicacislo.min' => 'Ulica a číslo musia obsahovať aspoň 3 znaky.',
            'ulicacislo.max' => 'Ulica a číslo môžu obsahovať najviac 255 znakov.',
            'mestoobec.required_with' => 'Mesto je povinné, ak je zadaná ulica alebo PSČ.',
            'mestoobec.min' => 'Mesto musí obsahovať aspoň 1 znak.',
            'mestoobec.max' => 'Mesto môže obsahovať najviac 255 znakov.',
            'psc.required_with' => 'PSČ je povinné, ak je zadaná ulica alebo mesto.',
            'psc.min' => 'PSČ musí obsahovať medzeru - 6 znakov .',
            'psc.max' => 'PSČ môže obsahovať medzeru - 6 znakov.',
            'coursetypes_id.array' => 'Pole typov kurzov musí byť pole.',
            'coursetypes_id.*.distinct' => 'Typy kurzov musia byť jedinečné.',
            'coursetypes_id.*.exists' => 'Vybraný typ kurzu neexistuje.',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with('applications', 'classes');

        if ($request->filled('search')) {
            $search = '%' . $request->input('search') . '%';
            $students->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('lastname', 'like', $search)
                    ->orWhere('email', 'like', $search);
            });
        }

        if ($request->filled('orderBy')) {
            if ($request->orderBy == 'applications_count') {
                $students->withCount('applications')
                    ->orderBy('applications_count', $request->input('orderDirection'));
            } else {
                $orderBy = $request->input('orderBy');
                $orderDirection = $request->input('orderDirection');
                $students->orderBy($orderBy, $orderDirection);
            }
        } else {
            $students->orderBy('created_at', 'desc');
        }

        $students = $students->paginate(10);

        return view('admin.students-index', [
            'students' => $students
        ]);
    }

    public function show(Student $student)
    {
        return view('admin.students-show', ['student' => $student]);
    }

    public function create()
    {
        return view('admin.students-create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'different:sekemail', 'max:255', Rule::unique('students', 'email'), Rule::unique('students', 'sekemail')],
            'sekemail' => ['nullable', 'different:email', 'email', 'max:255', Rule::unique('students', 'email'), Rule::unique('students', 'sekemail')],
            'status' => ['required', 'min:7', 'max:9'],
            'skola' => ['nullable', 'min:3', 'max:3', 'required_if:status,student'],
            'ina' => ['max:255', 'required_if:skola,ina',],
            'studium' => ['nullable', 'min:7', 'max:7', 'required_if:skola,ucm'],
            'program' => ['nullable', 'min:3', 'max:4', 'required_if:skola,ucm'],
            'iny' => ['max:255', 'required_if:program,iny'],
            'ulicacislo' => ['required', 'min:3', 'max:255'],
            'mestoobec' => ['required', 'min:1', 'max:255'],
            'psc' => ['required', 'min:6', 'max:6'],
        ], $this->messages());
        if ($attributes['status'] == "nestudent") {
            $student = Student::create([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc'],
            ]);
        } else if ($attributes['skola'] == "ina") {
            $student = Student::create([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'skola' => $attributes['ina'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc']
            ]);
        } else if ($attributes['program'] == "apin") {
            $student = Student::create([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'skola' => $attributes['skola'],
                'studium' => $attributes['studium'],
                'program' => $attributes['program'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc']
            ]);
        } else {
            $student = Student::create([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'skola' => $attributes['skola'],
                'studium' => $attributes['studium'],
                'program' => $attributes['iny'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc']
            ]);
        }

        return redirect('/admin/applications/create?student_id=' . urlencode($student['id']))->with('success_c', 'Úspešne vytvorené');
    }
    public function update(Student $student)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'different:sekemail', 'max:255', Rule::unique('students', 'email')->ignore($student), Rule::unique('students', 'sekemail')->ignore($student)],
            'sekemail' => ['nullable', 'different:email', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student), Rule::unique('students', 'sekemail')->ignore($student)],
            'status' => ['required', 'min:7', 'max:9'],
            'skola' => ['nullable', 'min:3', 'max:3', 'required_if:status,student'],
            'ina' => ['max:255', 'required_if:skola,ina',],
            'studium' => ['nullable', 'min:7', 'max:7', 'required_if:skola,ucm'],
            'program' => ['nullable', 'min:3', 'max:4', 'required_if:skola,ucm'],
            'iny' => ['max:255', 'required_if:program,iny'],
            'ulicacislo' => ['required', 'min:3', 'max:255'],
            'mestoobec' => ['required', 'min:1', 'max:255'],
            'psc' => ['required', 'min:6', 'max:6'],
        ], $this->messages());
        if ($attributes['status'] == "nestudent") {
            if ($student['status'] == 'student') {
                $student->update([
                    'skola' => null,
                    'studium' => null,
                    'program' => null
                ]);
            }
            $student->update([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc'],
            ]);
        } else if ($attributes['skola'] == "ina") {
            if ($student['skola'] == 'ucm') {
                $student->update([
                    'studium' => null,
                    'program' => null
                ]);
            }
            $student->update([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'skola' => $attributes['ina'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc']
            ]);
        } else if ($attributes['program'] == "apin") {
            $student->update([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'skola' => $attributes['skola'],
                'studium' => $attributes['studium'],
                'program' => $attributes['program'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc']
            ]);
        } else {
            $student->update([
                'name' => $attributes['name'],
                'lastname' => $attributes['lastname'],
                'email' => $attributes['email'],
                'sekemail' => $attributes['sekemail'],
                'status' => $attributes['status'],
                'skola' => $attributes['skola'],
                'studium' => $attributes['studium'],
                'program' => $attributes['iny'],
                'ulicacislo' => $attributes['ulicacislo'],
                'mestoobec' => $attributes['mestoobec'],
                'psc' => $attributes['psc']
            ]);
        }

        $student->touch();

        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }

        return back()->with('success_u', 'Úspešne aktualizované');
    }
    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success_d', 'Úspešne vymazané');
    }

    public function search(Request $request)
    {
        $name = $request->get('name');
        $lastname = $request->get('lastname');
        $email = $request->get('email');

        $students = Student::query()
            ->where('name', 'like', '%' . $name . '%')
            ->where('lastname', 'like', '%' . $lastname . '%')
            ->where(function ($query) use ($email) {
                $query->where('email', 'like', '%' . $email . '%')
                    ->orWhere('sekemail', 'like', '%' . $email . '%');
            })
            ->get();

        return response()->json($students);
    }

    protected function messages()
    {
        return [
            'name.required' => 'Meno je povinné.',
            'name.max' => 'Meno môže mať maximálne :max znakov.',
            'lastname.required' => 'Priezvisko je povinné.',
            'lastname.max' => 'Priezvisko môže mať maximálne :max znakov.',
            'email.required' => 'E-mailová adresa je povinná.',
            'email.email' => 'E-mailová adresa musí byť platná.',
            'email.max' => 'E-mailová adresa môže mať maximálne :max znakov.',
            'email.unique' => 'Tento e-mail už je zaregistrovaný.',
            'sekemail.email' => 'Sekundárna e-mailová adresa musí byť platná.',
            'sekemail.max' => 'Sekundárna e-mailová adresa môže mať maximálne :max znakov.',
            'status.required' => 'Status je povinný.',
            'sekemail.unique' => 'Tento e-mail už je zaregistrovaný.',
            'status.min' => 'Status musí mať minimálne :min znakov.',
            'status.max' => 'Status môže mať maximálne :max znakov.',
            'skola.required_if' => 'Škola je povinná, keď je status študent.',
            'skola.min' => 'Škola musí mať minimálne :min znakov.',
            'skola.max' => 'Škola môže mať maximálne :max znakov.',
            'ina.max' => 'Iná informácia môže mať maximálne :max znakov.',
            'ina.required_if' => 'Názov školy je povinný.',
            'studium.min' => 'Štúdium musí mať minimálne :min znakov.',
            'studium.max' => 'Štúdium môže mať maximálne :max znakov.',
            'studium.required_if' => 'Štúdium je povinné, keď je škola UCM.',
            'program.min' => 'Program musí mať minimálne :min znakov.',
            'program.max' => 'Program môže mať maximálne :max znakov.',
            'program.required_if' => 'Program je povinný, keď je škola UCM.',
            'iny.max' => 'Iný program môže mať maximálne :max znakov.',
            'iny.required_if' => 'Názov programu je povinný.',
            'ulicacislo.required' => 'Ulica a číslo domu sú povinné.',
            'ulicacislo.min' => 'Ulica a číslo domu musia mať minimálne :min znakov.',
            'ulicacislo.max' => 'Ulica a číslo domu môžu mať maximálne :max znakov.',
            'mestoobec.required' => 'Mesto/Obec je povinné.',
            'mestoobec.min' => 'Mesto/Obec musí mať minimálne :min znakov.',
            'mestoobec.max' => 'Mesto/Obec môže mať maximálne :max znakov.',
            'psc.required' => 'PSČ je povinné.',
            'psc.min' => 'PSČ musí mať minimálne :min znakov.',
            'psc.max' => 'PSČ môže mať maximálne :max znakov.',

        ];
    }
}

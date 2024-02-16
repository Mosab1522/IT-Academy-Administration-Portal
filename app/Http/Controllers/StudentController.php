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
        if ($request->filled('search')) {
            $students = Student::with('applications')->where('name', 'like', '%' . $request->input('search') . '%')->orWhere('lastname', 'like', '%' . $request->input('search') . '%')->orWhere('email', 'like', '%' . $request->input('search') . '%');
        } else {
            $students = Student::with('applications');
        }

        // dd($request->input('search'));
        // spracovanie filtrov

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $students->orderBy($orderBy, $orderDirection);
        } else {
            $students->orderBy('created_at', 'desc');
        }

        $students = $students->get();

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
        // dd($_REQUEST);
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'sekemail' => ['nullable', 'email', 'max:255'],
            'status' => ['required', 'min:7', 'max:9'],
            'skola' => ['nullable', 'min:3', 'max:3', 'required_if:status,student'],
            'ina' => ['max:255', 'required_if:skola,ina',],
            'studium' => ['nullable', 'min:7', 'max:7', 'required_if:skola,ucm'],
            'program' => ['nullable', 'min:3', 'max:4', 'required_if:skola,ucm'],
            'iny' => ['max:255', 'required_if:program,iny'],
            'ulicacislo' => ['required', 'min:3', 'max:255'],
            'mestoobec' => ['required', 'min:1', 'max:255'],
            'psc' => ['required', 'min:6', 'max:6'],
        ]);
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
        // dd($student);

        // session(['student_id' => $student['id']]);

        // return redirect('/admin/applications/create')->with('student_id', $student['id']);
        return redirect('/admin/applications/create?student_id=' . urlencode($student['id']))->with('success_c', 'Úspešne vytvorené');

    }
    public function update(Student $student)
    {
        //  dd(request()->all());
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'sekemail' => ['nullable', 'email', 'max:255'],
            'status' => ['required', 'min:7', 'max:9'],
            'skola' => ['nullable', 'min:3', 'max:3', 'required_if:status,student'],
            'ina' => ['max:255', 'required_if:skola,ina',],
            'studium' => ['nullable', 'min:7', 'max:7', 'required_if:skola,ucm'],
            'program' => ['nullable', 'min:3', 'max:4', 'required_if:skola,ucm'],
            'iny' => ['max:255', 'required_if:program,iny'],
            'ulicacislo' => ['required', 'min:3', 'max:255'],
            'mestoobec' => ['required', 'min:1', 'max:255'],
            'psc' => ['required', 'min:6', 'max:6'],
            //   'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
            // 'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
            // 'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
            // 'days' => ['required', 'integer'],
            // 'time' => ['required', 'integer'],
        ]);
        if ($attributes['status'] == "nestudent") {
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

        //$student->update($attributes);
        $student->touch();

        if (Str::endsWith(url()->previous(), '?pridat'))
        {
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

        // Debugging
        // dd($students); // This will help you see the retrieved students


        return response()->json($students);
    }
}

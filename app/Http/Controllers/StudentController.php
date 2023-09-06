<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

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
            'name' => ['max:255'],
            'lastname' => ['max:255'],
            'email' => ['required', 'email', 'max:255'],
            'sekemail' => ['nullable','email', 'max:255'],
            'status' => ['nullable', 'min:7', 'max:9'],
            'skola' => ['nullable', 'min:3', 'max:3'],
            'ina' => ['max:255'],
            'studium' => ['nullable', 'min:7', 'max:7'],
            'program' => ['nullable', 'min:3', 'max:4'],
            'iny' => ['max:255'],
            'ulicacislo' => ['nullable', 'min:3', 'max:255'],
            'mestoobec' => ['nullable', 'min:1', 'max:255'],
            'psc' => ['nullable','min:6', 'max:6']
        ]);
        $student = Student::create($attributes);
        // dd($student);

        // session(['student_id' => $student['id']]);

        // return redirect('/admin/applications/create')->with('student_id', $student['id']);
        return redirect('/admin/applications/create?student_id=' . urlencode($student['id']));

    }
    public function update(Student $student)
    {
        $attributes = request()->validate([
            'name' => ['max:255'],
            'lastname' => ['max:255'],
            'email' => ['required', 'email', 'max:255'],
            'sekemail' => ['nullable','email', 'max:255'],
            'status' => ['nullable', 'min:7', 'max:9'],
            'skola' => ['nullable', 'min:3', 'max:3'],
            'ina' => ['max:255'],
            'studium' => ['nullable', 'min:7', 'max:7'],
            'program' => ['nullable', 'min:3', 'max:4'],
            'iny' => ['max:255'],
            'ulicacislo' => ['nullable', 'min:3', 'max:255'],
            'mestoobec' => ['nullable', 'min:1', 'max:255'],
            'psc' => ['nullable','min:6', 'max:6']
        ]);
        $student->update($attributes);
        $student->touch();

        return back();
    }
    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'Post deleted successfully');
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

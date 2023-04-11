<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.students-index', [
            'students' => Student::with('applications')->get()
        ]);
    }

    public function search(Request $request)
{
    $name = $request->get('name');
    $lastname = $request->get('lastname');
    $email = $request->get('email');

    $students = Student::query()
        ->where('name', 'like', '%' . $name . '%')
        ->where('lastname', 'like', '%' . $lastname . '%')
        ->where('email', 'like', '%' . $email . '%')
        ->get();

    return response()->json($students);
}
}

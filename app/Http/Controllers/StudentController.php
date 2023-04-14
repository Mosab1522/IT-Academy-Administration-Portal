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

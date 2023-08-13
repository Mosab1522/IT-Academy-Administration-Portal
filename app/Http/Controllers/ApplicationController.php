<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Application;
use App\Models\CourseType;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ApplicationController extends Controller
{

    public function index(Request $request)
    {
        if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
            $filter = $request->input('coursetype_id');
            $applications = Application::with(['academy', 'coursetype', 'student'])->where('coursetype_id', $filter);
        } else if ($request->filled('academy_id')) {
            $filter = $request->input('academy_id');
            $applications = Application::with(['academy', 'coursetype', 'student'])->where('academy_id', $filter);
        } else {
            $applications = Application::with(['academy', 'coursetype', 'student']);
        }

        //   dd($request);
        if ($request->filled('search')) {
            $applications = $applications
                ->whereHas('student', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%')->orWhere('lastname', 'like', '%' . $request->input('search') . '%')->orWhere('email', 'like', '%' . $request->input('search') . '%');
                })->orWhereHas('academy', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                })->orWhereHas('coursetype', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
        }

        // dd($request->input('search'));
        // spracovanie filtrov

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $applications->orderBy($orderBy, $orderDirection);
        } else {
            $applications->orderBy('created_at', 'desc');
        }


        $applications = $applications->get();

        // získanie prihlášok

        return view('admin.applications-index', [
            'applications' => $applications
        ]);
    }

    public function create()
    {
        return view('applications-create');
    }


    public function store()
    {
        session(['typ' => request()->typ]);

        $email['email'] = request()->email;
        // $email['sekemail'] = request()->sekemail;

        $sekemail['sekemail'] = request()->sekemail;
        // $sekemail['email'] = request()->email;

        $rule = array('email' => [Rule::unique('students', 'email')]);
        $validation = Validator($email, $rule);

        $rule2 = array('email' => [Rule::unique('students', 'sekemail')]);
        $validation2 = Validator($email, $rule2);

        $rule3 = array('sekemail' => [Rule::unique('students', 'email')]);
        $validation3 = Validator($sekemail, $rule3);

        $rule4 = array('sekemail' => [Rule::unique('students', 'sekemail')]);
        $validation4 = Validator($sekemail, $rule4);

        if ($validation->fails() || $validation2->fails()|| $validation3->fails()|| $validation4->fails()) {
            if (request()->typ == "novy") {
                throw ValidationException::withMessages(['email' => 'Tento email vedieme v systéme. Využite Zjednodušenú registráciu.']);
            }
            
            // $rule1 = Rule::exists('students', 'name')->where('email', request()->email);
            // $rule2 = Rule::exists('students', 'lastname')->where('email', request()->email);
            // $rule3 = Rule::exists('students', 'lastname')->where('email', request()->email);

            $student = Student::firstWhere('email', $email['email']) ?? Student::firstWhere('sekemail', $email['email']);
            // dd($student);
            // $student ??= Student::firstWhere('sekemail', $email['email']);
            $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            $value['student_id'] = $student['id'];
            $validation = Validator($value, $rule);
            if ($validation->fails()) {
                throw ValidationException::withMessages(['email' => 'Takáto prihláška už existuje']);
            } else {
                $attributes = request()->validate([

                    'email' => ['required', 'email', 'max:255'],
                    // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                    'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
                    'days' => ['required', 'integer'],
                    'time' => ['required', 'integer'],
                ]);
                // $student = Student::firstWhere('email', $email['email']);
            }
        } else {
            if (request()->typ == "stary") {
                throw ValidationException::withMessages(['email' => 'Tento email nevedieme v systéme. Využite Úplnú registráciu.']);
            }
            if ($email['email'] == $sekemail['sekemail']) {
                throw ValidationException::withMessages(['email' => 'Zadali ste totožné emaily.']);
            }

            $attributes = request()->validate([
                'name' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'sekemail' => ['required', 'email', 'max:255'],
                'status' => ['required', 'min:7', 'max:9'],
                'skola' => ['required_if:status,student'],
                'ina' => ['required_if:skola,ina',],
                'studium' => ['required_if:skola,ucm'],
                'program' => ['required_if:skola,ucm'],
                'iny' => ['required_if:program,iny'],
                'ulicacislo' => ['required', 'min:3', 'max:255'],
                'mestoobec' => ['required', 'min:1', 'max:255'],
                'psc' => ['required', 'min:6', 'max:6'],
                //   'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
                'days' => ['required', 'integer'],
                'time' => ['required', 'integer'],
            ]);


            $students_a['name'] = request()->name;
            $students_a['lastname'] = request()->lastname;
            $students_a['email'] = request()->email;
            $students_a['sekemail'] = request()->sekemail;
            $students_a['ulicacislo'] = request()->ulicacislo;
            $students_a['mestoobec'] = request()->mestoobec;
            $students_a['psc'] = request()->psc;

            $student = Student::create([
                'name' => $students_a['name'],
                'lastname' => $students_a['lastname'],
                'email' => $students_a['email'],
                'sekemail' => $students_a['sekemail'],
                'status' => request()->status,
                'skola' => request()->skola,
                'studium' => request()->studium,
                'program' => request()->iny,
                'ulicacislo' => $students_a['ulicacislo'],
                'mestoobec' => $students_a['mestoobec'],
                'psc' => $students_a['psc']
            ]);

            // if (request()->status == "nestudent") {
            //     $student = Student::create([
            //         'name' => $students_a['name'],
            //         'lastname' => $students_a['lastname'],
            //         'email' => $students_a['email'],
            //         'sekemail' => $students_a['sekemail'],
            //         'status' => request()->status,
            //         'ulicacislo' => $students_a['ulicacislo'],
            //         'mesoobec' => $students_a['mestoobec'],
            //         'psc' => $students_a['psc'],
            //     ]);
            // } else if (request()->skola == "ina") {
            //     $student = Student::create([
            //         'name' => $students_a['name'],
            //         'lastname' => $students_a['lastname'],
            //         'email' => $students_a['email'],
            //         'sekemail' => $students_a['sekemail'],
            //         'status' => request()->status,
            //         'skola' => request()->ina,
            //         'ulicacislo' => $students_a['ulicacislo'],
            //         'mestoobec' => $students_a['mestoobec'],
            //         'psc' => $students_a['psc']
            //     ]);
            // } else if (request()->program == "apin") {
            //     $student = Student::create([
            //         'name' => $students_a['name'],
            //         'lastname' => $students_a['lastname'],
            //         'email' => $students_a['email'],
            //         'sekemail' => $students_a['sekemail'],
            //         'status' => request()->status,
            //         'skola' => request()->skola,
            //         'studium' => request()->studium,
            //         'program' => request()->program,
            //         'ulicacislo' => $students_a['ulicacislo'],
            //         'mestoobec' => $students_a['mestoobec'],
            //         'psc' => $students_a['psc']
            //     ]);
            // } else {
            //     $student = Student::create([
            //         'name' => $students_a['name'],
            //         'lastname' => $students_a['lastname'],
            //         'email' => $students_a['email'],
            //         'sekemail' => $students_a['sekemail'],
            //         'status' => request()->status,
            //         'skola' => request()->skola,
            //         'studium' => request()->studium,
            //         'program' => request()->iny,
            //         'ulicacislo' => $students_a['ulicacislo'],
            //         'mestoobec' => $students_a['mestoobec'],
            //         'psc' => $students_a['psc']
            //     ]);
            // }
        }


        Application::create([
            'student_id' => $student['id'],
            'academy_id' => $attributes['academy_id'],
            'coursetype_id' => $attributes['coursetype_id'],
            'days' => $attributes['days'],
            'time' => $attributes['time']
        ]);
        session()->forget('student_id');
        session()->forget('coursetype_id');

        return back();
    }
    public function admincreate()
    {
        return view('admin.applications-create');
    }
}

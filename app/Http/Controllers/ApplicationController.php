<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use App\Models\Academy;
use App\Models\Application;
use App\Models\CourseType;
use App\Models\Instructor;
use App\Models\Student;
use App\Notifications\NewStudent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

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

    public function show(Application $application,)
    {
        return view('admin.applications-show', ['application' => $application]);
    }


    public function create()
    {
        return view('applications-create');
    }


    public function store()
    {
        if (request()->student_id) {

            $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . request()->student_id . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            $value['student_id'] = request()->student_id;
            $validation = Validator($value, $rule);
            if ($validation->fails()) {
                throw ValidationException::withMessages(['name' => 'Takáto prihláška už existuje']);
            } else {
                $attributes = request()->validate([

                    'student_id' => ['required', 'integer', Rule::exists('students', 'id')],
                    // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                    'type' => ['required', 'integer', 'in:0,1,2'],
                    'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
                    'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
                    'days' => ['required', 'integer'],
                    'time' => ['required', 'integer'],
                ]);
                // dd(request()->all());
                // $student = Student::firstWhere('email', $email['email']);
                if($attributes['type'] == 0)
                {
                    $attributes['academy_id'] = $attributes['academy_id2'];
                    $attributes['coursetype_id'] = $attributes['coursetype_id2'];
                }
                Application::create([
                    'student_id' => $attributes['student_id'],
                    'academy_id' => $attributes['academy_id'],
                    'coursetype_id' => $attributes['coursetype_id'],
                    'days' => $attributes['days'],
                    'time' => $attributes['time']
                ]);

                if (Str::endsWith(url()->previous(), '?pridat')) {
                    $trimmedUrl = substr(url()->previous(), 0, -7);
                    return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
                }

                return back()->with('success_c', 'Úspešne vytvorené');
            }
        }
        // session(['typ' => request()->typ]);

        $email['email'] = request()->email;
        // $email['sekemail'] = request()->sekemail;

        $sekemail['sekemail'] = request()->sekemail ?? '/';
        // $sekemail['email'] = request()->email;

        $rule = array('email' => [Rule::unique('students', 'email')]);
        $validation = Validator($email, $rule);

        $rule2 = array('email' => [Rule::unique('students', 'sekemail')]);
        $validation2 = Validator($email, $rule2);

        $rule3 = array('sekemail' => [Rule::unique('students', 'email')]);
        $validation3 = Validator($sekemail, $rule3);

        $rule4 = array('sekemail' => [Rule::unique('students', 'sekemail')]);
        $validation4 = Validator($sekemail, $rule4);


        if ($validation->fails() || $validation2->fails() || $validation3->fails() || $validation4->fails()) {
            if (request()->typ == "novy") {
                throw ValidationException::withMessages(['email' => 'Tento email vedieme v systéme. Využite Zjednodušenú registráciu.']);
            }

            // $rule1 = Rule::exists('students', 'name')->where('email', request()->email);
            // $rule2 = Rule::exists('students', 'lastname')->where('email', request()->email);
            // $rule3 = Rule::exists('students', 'lastname')->where('email', request()->email);

            $student = Student::firstWhere('email', $email['email']) ?? Student::firstWhere('sekemail', $email['email']);

            if (request()->typ == "admin") {
                if($student['name']!= request()->name)
                {
                     throw ValidationException::withMessages(['name' => 'Tento email vedieme v systéme pod iným menom.']);
                }
                if($student['lastname']!= request()->lastname)
                {
                throw ValidationException::withMessages(['lastname' => 'Tento email vedieme v systéme pod iným priezviskom.']);
                }
            }
            // dd($student);
            // $student ??= Student::firstWhere('sekemail', $email['email']);
            $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            $value['student_id'] = $student['id'];
            $validation = Validator($value, $rule);
            if ($validation->fails()) {
                throw ValidationException::withMessages(['email' => 'Takáto prihláška už existuje']);
            } else {
                // if(request()->type)
                
                if(request()->typ == "admin")
                {
                    if(!request()->type)
                    {
                        $coursetype = CourseType::firstWhere('id', request()->coursetype_id);
                        request()->merge(['type' => $coursetype['id']]);
                    }
                    $attributes = request()->validate([
                    
                        'email' => ['required', 'email', 'max:255'],
                        // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                        'type' => ['required', 'integer', 'in:0,1'],
                        'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                        'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
                        'days' => ['required', 'integer'],
                        'time' => ['required', 'integer'],
                    ]);
                    
                }else {
                    
                    $attributes = request()->validate([     
                    'email' => ['required', 'email', 'max:255'],
                    // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                    'type2' => ['required', 'integer', 'in:0,1'],
                    'academy_id' => ['required_if:type2,1', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id' => ['required_if:type2,1', 'integer', Rule::exists('course_types', 'id')],
                    'academy_id2' => ['required_if:type2,0', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id2' => ['required_if:type2,0', 'integer', Rule::exists('course_types', 'id')],
                    'days' => ['required', 'integer'],
                    'time' => ['required', 'integer'],
                ]);
                }
                
                // $student = Student::firstWhere('email', $email['email']);
            }
        } else {
            if (request()->typ != "novy") {
                throw ValidationException::withMessages(['email' => 'Tento email nevedieme v systéme. Využite Úplnú registráciu.']);
            }
            
            
            if ($email['email'] == $sekemail['sekemail']) {
                throw ValidationException::withMessages(['email' => 'Zadali ste totožné emaily.']);
            }

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
                'type' => ['required', 'integer', 'in:0,1,2'],
                'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
                'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
                'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
                'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
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

            // $student = Student::create([
            //     'name' => $students_a['name'],
            //     'lastname' => $students_a['lastname'],
            //     'email' => $students_a['email'],
            //     'sekemail' => $students_a['sekemail'],
            //     'status' => request()->status,
            //     'skola' => request()->skola,
            //     'studium' => request()->studium,
            //     'program' => request()->iny,
            //     'ulicacislo' => $students_a['ulicacislo'],
            //     'mestoobec' => $students_a['mestoobec'],
            //     'psc' => $students_a['psc']
            // ]);

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
        }
        if(request()->typ== "novy")
        {
             if($attributes['type'] == 0 )
        {
            $attributes['academy_id'] = $attributes['academy_id2'];
            $attributes['coursetype_id'] = $attributes['coursetype_id2'];
        }
        }else if(request()->typ== "stary")
        {
             if($attributes['type2'] == 0 )
        {
            $attributes['academy_id'] = $attributes['academy_id2'];
            $attributes['coursetype_id'] = $attributes['coursetype_id2'];
        }
        }
       
        
        $application = Application::create([
            'student_id' => $student['id'],
            'academy_id' => $attributes['academy_id'],
            'coursetype_id' => $attributes['coursetype_id'],
            'days' => $attributes['days'],
            'time' => $attributes['time'],
            'verification_token' => Str::random(60)
        ]);
        session()->forget('student_id');
        session()->forget('coursetype_id');

        $course = CourseType::firstWhere('id', $attributes['coursetype_id']);

        
        // Assuming you know the instructor's ID


        
        // $application->verification_token = Str::random(40);
        // $application->save();

        $emailData = ['email' => $student['email'], 'name' => $student['name'] , 'lastname' => $student['lastname'],'id' => $course['id'], 'coursename' => $course['name'], 'coursetype' => $course['type'], 'academyname' => $course->academy['name'], 'date' => Carbon::now(), 'verificationToken' => $application->verification_token];
        
        // foreach ($course->instructors as $instructor)
        // {
        //      $instructor->notify(new NewStudent($emailData));
        // }

        // Mail::to($emailData['email'])->send(new ConfirmationMail($emailData));
        
        if (Str::endsWith(url()->previous(), '?vytvorit'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }
        if (request()->typ != "admin")
        {
            return back()->with('success_c', $attributes['email']);
        }
        return back()->with('success_c', 'Úspešne vytvorené');
    }
    public function destroy(Application $application)
    {
        $application->delete();

        if (Str::endsWith(url()->previous(), '?pridat'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }

        return back()->with('success_d', 'Úspešne vymazané');
    }

    public function admincreate()
    {
        return view('admin.applications-create');
    }

    public function verify($token)
{
    $application = Application::where('verification_token', $token)->firstOrFail();
    if($application->verified == false)
    {
    $application->verified = true;
    //$application->verification_token = null; // Clear the token after use
    $application->verified_at = Carbon::now();
    $application->save(); 
    return view('confirmation')->with('success', 'Application confirmed successfully.');
    }else{
    return view('confirmation')->with('already', 'Already confirmed.');
    }
}
}

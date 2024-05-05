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
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ApplicationController extends Controller
{

    public function index(Request $request)
    {
        if(Gate::denies('admin'))
        {
            $authInstructorId = auth()->user()->user_id;
            $applications = Application::with(['academy', 'coursetype', 'student'])->whereHas('coursetype.instructors', function ($query) use ($authInstructorId) {
                $query->where('instructors.id', $authInstructorId);
            });
        }else{
           $applications = Application::with(['academy', 'coursetype', 'student']); 
        }
        

        // Check for academy_id and coursetype_id filters.
        if ($request->filled('academy_id')) {
            $academyId = $request->input('academy_id');
            $coursetypeId = $request->input('coursetype_id', null);
        
            // Filter applications based on academy_id and optionally coursetype_id.
            $applications->whereHas('coursetype', function ($query) use ($academyId, $coursetypeId) {
                $query->where('academy_id', $academyId);
                if (!is_null($coursetypeId)) {
                    $query->where('id', $coursetypeId);
                }
            });
        }
        
        // Apply search conditions if 'search' is provided.
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $applications->where(function ($query) use ($searchTerm) {
                $query->whereHas('student', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('name', 'like', $searchTerm)
                             ->orWhere('lastname', 'like', $searchTerm)
                             ->orWhere('email', 'like', $searchTerm);
                })->orWhereHas('academy', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('name', 'like', $searchTerm);
                })->orWhereHas('coursetype', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('name', 'like', $searchTerm);
                });
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


        $applications = $applications->paginate(10);

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
            request()->validate([ 'student_id' => ['required', 'integer', Rule::exists('students', 'id')]]);
            
            $student = Student::firstWhere('id', request()->student_id);
        
            if (request()->type == 0) {
                $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id2 . ',coursetype_id,' . request()->coursetype_id2);
            } else if (request()->type == 1) {
                $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            }

            $value['student_id'] = $student['id'];


            if ($student->classes->count() > 0) {
                foreach ($student->classes as $class) {
                    if ($class->coursetype->id == request()->coursetype_id && request()->type == 1) {

                        throw ValidationException::withMessages(['type' => 'Žiak je zapísaný v triede tohoto kurzu.','academy_id' => 'Žiak je zapísaný v triede tohoto kurzu.','coursetype_id' => 'Žiak je zapísaný v triede tohoto kurzu.'])->errorBag('admin');
                    }

                    if ($class->coursetype->id == request()->coursetype_id2 && request()->type == 0) {

                        throw ValidationException::withMessages(['type' => 'Žiak je zapísaný v triede tohoto kurzu.','academy_id2' => 'Žiak je zapísaný v triede tohoto kurzu.','coursetype_id2' => 'Žiak je zapísaný v triede tohoto kurzu.'])->errorBag('admin');
                    }
                }
            }
            $validation = Validator($value, $rule);
            if ($validation->fails()) {
                if (request()->type == 1)
                {
                     throw ValidationException::withMessages(['type' => 'Takáto prihláška už existuje.','academy_id' => 'Takáto prihláška už existuje.','coursetype_id' => 'Takáto prihláška už existuje.'])->errorBag('admin');
                }
                if (request()->type == 0)
                {
                    throw ValidationException::withMessages(['type' => 'Takáto prihláška už existuje.','academy_id2' => 'Takáto prihláška už existuje.','coursetype_id2' => 'Takáto prihláška už existuje.'])->errorBag('admin');
                }
               

                
            } else {
                $attributes = request()->validateWithBag('admin',[

                    'student_id' => ['required', 'integer', Rule::exists('students', 'id')],
                    // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                    'type' => ['required', 'integer', 'in:0,1,2'],
                    'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
                    'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
                    'days' => ['required', 'integer', 'in:1,2,3'],
                    'time' => ['required', 'integer', 'in:1,2,3']
                ],$this->messages());
                // dd(request()->all());
                // $student = Student::firstWhere('email', $email['email']);
                if ($attributes['type'] == 0) {
                    $attributes['academy_id'] = $attributes['academy_id2'];
                    $attributes['coursetype_id'] = $attributes['coursetype_id2'];
                }
                Application::create([
                    'student_id' => $attributes['student_id'],
                    'academy_id' => $attributes['academy_id'],
                    'coursetype_id' => $attributes['coursetype_id'],
                    'days' =>   $attributes['days'],
                    'time' =>   $attributes['time']
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

        $rule = array('email' => [ Rule::unique('students', 'email')]);
        $validation = Validator($email, $rule);

        $rule2 = array('email' => [Rule::unique('students', 'sekemail')]);
        $validation2 = Validator($email, $rule2);

        $rule3 = array('sekemail' => [Rule::unique('students', 'email')]);
        $validation3 = Validator($sekemail, $rule3);

        $rule4 = array('sekemail' => [ Rule::unique('students', 'sekemail')]);
        $validation4 = Validator($sekemail, $rule4);
      
       
        if ($validation->fails() || $validation2->fails() || $validation3->fails() || $validation4->fails()) {
            if (request()->typ == "novy") {
                if($email['email'] ?? null)
                {
throw ValidationException::withMessages(['email' => 'Tento email vedieme v systéme. Využite Zjednodušenú registráciu.'])->errorBag('novy');
                }
                if($sekemail['email'] ?? null)
                {
throw ValidationException::withMessages(['sekemail' => 'Tento email vedieme v systéme. Využite Zjednodušenú registráciu.'])->errorBag('novy');
                }
                throw ValidationException::withMessages(['email' => 'Email je povinný'])->errorBag('novy');
                
            }
            if (request()->typ == "admin") {
                request()->validateWithBag('admin',[
                    'name' => ['required', 'max:255'],
                    'lastname' => ['required', 'max:255'],
                    'email' => ['required', 'email']
                ] , $this->messages());
            }


            // $rule1 = Rule::exists('students', 'name')->where('email', request()->email);
            // $rule2 = Rule::exists('students', 'lastname')->where('email', request()->email);
            // $rule3 = Rule::exists('students', 'lastname')->where('email', request()->email);

            $student = Student::firstWhere('email', $email['email']) ?? Student::firstWhere('sekemail', $email['email']);
            
            if (request()->typ == "admin") {
                if ($student['name'] != request()->name) {
                    throw ValidationException::withMessages(['name' => 'Tento email vedieme v systéme pod iným menom.']);
                }
                if ($student['lastname'] != request()->lastname) {
                    throw ValidationException::withMessages(['lastname' => 'Tento email vedieme v systéme pod iným priezviskom.']);
                }
            }
            // dd($student);
            // $student ??= Student::firstWhere('sekemail', $email['email']);
           

            if ($student->classes->count() > 0) {
                foreach ($student->classes as $class) {
                    if ($class->coursetype->id == request()->coursetype_id && request()->type2 == 1) {

                        throw ValidationException::withMessages(['email' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.'])->errorBag('stary');
                    }

                    if ($class->coursetype->id == request()->coursetype_id2 && request()->type2 == 0) {

                        throw ValidationException::withMessages(['email' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.'])->errorBag('stary');
                    }

                    if ($class->coursetype->id == request()->coursetype_id && request()->type == 1) {

                        throw ValidationException::withMessages(['email' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.', 'name' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.' , 'lastname' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.'])->errorBag('admin');
                    }

                    if ($class->coursetype->id == request()->coursetype_id2 && request()->type == 0) {

                        throw ValidationException::withMessages(['email' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.', 'name' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.' , 'lastname' => 'Študenta s týmto emailom už vedieme u žiaka zaradeného do triedy v rovnakom kurze.'])->errorBag('admin');
                    }
                }
            }
            if (request()->type2 == 0 && request()->typ == "stary") {
                $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id2 . ',coursetype_id,' . request()->coursetype_id2);
            } else if (request()->type2 == 1 && request()->typ == "stary") {
                $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            }

            if (request()->type == 0 && request()->typ == "admin") {
                $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id2 . ',coursetype_id,' . request()->coursetype_id2);
            } else if (request()->type == 1 && request()->typ == "admin") {
                $rule = array('student_id' => 'unique:applications,student_id,NULL,id,student_id,' . $student['id'] . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            }

            $value['student_id'] = $student['id'];
            
            $validation = Validator($value, $rule);
            if ($validation->fails()) {
                if(request()->typ == "admin")
                {
                    throw ValidationException::withMessages(['email' => 'Takáto prihláška už existuje','name' => 'Takáto prihláška už existuje', 'lastname' => 'Takáto prihláška už existuje' ])->errorBag('admin');
                }
                else if(request()->typ == "stary")
                    {
                        throw ValidationException::withMessages(['email' => 'Takáto prihláška už existuje','name' => 'Takáto prihláška už existuje', 'lastname' => 'Takáto prihláška už existuje' ])->errorBag('stary');
                    }
                
            } else {

                // if(request()->type)
                
                if (request()->typ == "admin") {
                    if (!request()->type) {
                        $coursetype = CourseType::firstWhere('id', request()->coursetype_id);
                        request()->merge(['type' => $coursetype['type']]);
                    }
                    $attributes = request()->validateWithBag('admin',[

                        'email' => ['required', 'email', 'max:255'],
                        // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                        'type' => ['required', 'integer', 'in:0,1'],
                        'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
                        'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
                        'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
                        'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
                        'days' => ['required', 'integer', 'in:1,2,3'],
                        'time' => ['required', 'integer', 'in:1,2,3']
                    ] , $this->messages());
                } else {

                    $attributes = request()->validateWithBag('stary',[
                        'email' => ['required', 'email', 'max:255'],
                        // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                        'type2' => ['required', 'integer', 'in:0,1'],
                        'academy_id' => ['required_if:type2,1', 'integer', Rule::exists('academies', 'id')],
                        'coursetype_id' => ['required_if:type2,1', 'integer', Rule::exists('course_types', 'id')],
                        'academy_id2' => ['required_if:type2,0', 'integer', Rule::exists('academies', 'id')],
                        'coursetype_id2' => ['required_if:type2,0', 'integer', Rule::exists('course_types', 'id')],
                        'days' => ['required', 'integer', 'in:1,2,3'],
                        'time' => ['required', 'integer', 'in:1,2,3']
                    ] , $this->messages());
                }

                // $student = Student::firstWhere('email', $email['email']);
            }
        } else {
            if (request()->typ != "novy") {
                if(request()->typ == "stary")
                {
                    throw ValidationException::withMessages(['email' => 'Tento email nevedieme v systéme. Využite Úplnú registráciu.'])->errorBag('stary');
                }
                if(request()->typ == "admin")
                {
                    throw ValidationException::withMessages(['email' => 'Študenta s týmto emailom nevedieme v systéme. Najskôr vytvorte študenta.'])->errorBag('admin');
                }
                
            }


            if ($email['email'] == $sekemail['sekemail']) {
                throw ValidationException::withMessages(['email' => 'Zadali ste totožné emaily.', 'sekemail' => 'Zadali ste totožné emaily.'])->errorBag('novy');
            }

            $attributes = request()->validateWithBag('novy',[
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
                'days' => ['required', 'integer', 'in:1,2,3'],
                'time' => ['required', 'integer', 'in:1,2,3']
            ],$this->messages() );


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
        if (request()->typ == "novy") {
            if ($attributes['type'] == 0) {
                $attributes['academy_id'] = $attributes['academy_id2'];
                $attributes['coursetype_id'] = $attributes['coursetype_id2'];
            }
        } else if (request()->typ == "stary") {
            if ($attributes['type2'] == 0) {
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

        $emailData = ['student_id' => $student['id'], 'email' => $student['email'], 'name' => $student['name'], 'lastname' => $student['lastname'], 'id' => $course['id'], 'coursename' => $course['name'], 'coursetype' => $course['type'], 'academyname' => $course->academy['name'], 'date' => Carbon::now(), 'application_id' => $application->id, 'verificationToken' => $application->verification_token];
        if($course->applications->count() == $course->min)
        {
            $emailData['minimum'] =true;
       }else{
        $emailData['minimum'] =false;
       }
        foreach ($course->instructors as $instructor) {
           
                $instructor->notify(new NewStudent($emailData));
            
        }

        //Mail::to($emailData['email'])->send(new ConfirmationMail($emailData));

        if (Str::endsWith(url()->previous(), '?vytvorit')) {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }
        if (request()->typ != "admin") {
            return back()->with('success_c', $attributes['email']);
        }
        return back()->with('success_c', 'Úspešne vytvorené');
    }
    public function destroy(Application $application)
    {
        foreach ($application->coursetype->instructors as $instructor) {
            if ($instructor->unreadNotifications) {
                foreach ($instructor->unreadNotifications as $notification) {
                    if ($notification->data['application_id'] == $application->id) {
                        $notification->delete();
                    }
                }
            }
        }
        $application->forceDelete();


        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit')) {
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
        if ($application->verified == false) {
            $application->verified = true;
            //$application->verification_token = null; // Clear the token after use
            $application->verified_at = Carbon::now();
            $application->save();
            return view('confirmation')->with('success', 'Application confirmed successfully.');
        } else {
            return view('confirmation')->with('already', 'Already confirmed.');
        }
    }
    protected function messages()
    {
        return [
            'student_id.required' => 'Študent je povinný',
            'student_id.integer' => 'ID študenta musí byť celé číslo.',
            'student_id.exists' => 'Takýto študent neexistuje.',
            'name.required' => 'Meno je povinné.',
            'name.max' => 'Meno môže mať maximálne :max znakov.',
            'lastname.required' => 'Priezvisko je povinné.',
            'lastname.max' => 'Priezvisko môže mať maximálne :max znakov.',
            'email.required' => 'E-mailová adresa je povinná.',
            'email.email' => 'E-mailová adresa musí byť platná.',
            'email.max' => 'E-mailová adresa môže mať maximálne :max znakov.',
            'sekemail.email' => 'Sekundárna e-mailová adresa musí byť platná.',
            'sekemail.max' => 'Sekundárna e-mailová adresa môže mať maximálne :max znakov.',
            'status.required' => 'Status je povinný.',
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
            'iny.required_if' => 'Názov programu je povinný',
            'ulicacislo.required' => 'Ulica a číslo domu sú povinné.',
            'ulicacislo.min' => 'Ulica a číslo domu musia mať minimálne :min znakov.',
            'ulicacislo.max' => 'Ulica a číslo domu môžu mať maximálne :max znakov.',
            'mestoobec.required' => 'Mesto/Obec je povinné.',
            'mestoobec.min' => 'Mesto/Obec musí mať minimálne :min znakov.',
            'mestoobec.max' => 'Mesto/Obec môže mať maximálne :max znakov.',
            'psc.required' => 'PSČ je povinné.',
            'psc.min' => 'PSČ musí mať minimálne :min znakov.',
            'psc.max' => 'PSČ môže mať maximálne :max znakov.',
            'type.required' => 'Typ je povinný.',
            'type.integer' => 'Typ musí byť celé číslo.',
            'type.in' => 'Typ musí byť jedno z: :values.',
            'type2.required' => 'Typ je povinný.',
            'type2.integer' => 'Typ musí byť celé číslo.',
            'type2.in' => 'Typ musí byť jedno z: :values.',
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
            'time.in' => 'Čas musí byť jedno z: :values.',
        ];
    }
}

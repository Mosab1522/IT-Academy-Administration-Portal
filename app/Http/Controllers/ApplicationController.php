<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Application;
use App\Models\CourseType;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ApplicationController extends Controller
{

    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by');
    
        $lastApplications = Application::select(DB::raw('MAX(created_at) as last_created_at, coursetype_id'))
            ->groupBy('coursetype_id')
            ->pluck('last_created_at', 'coursetype_id');
    
        $types = CourseType::orderBy('name')->pluck('name', 'id');
    
        $types=$this->sort($sort_by,$types,$lastApplications);
    
        $applications = Application::with(['academy', 'coursetype', 'student'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(['coursetype.name', 'academy.name']);
    
        return view('admin.applications-index', compact('applications', 'lastApplications', 'types'));
    }

    public function filter(Request $request)
    {
        $applications = Application::with(['academy', 'coursetype', 'student']);

        // spracovanie filtrov
        if ($request->filled('filterBy')) {
            $filters = $request->input('filterBy');
            foreach ($filters as $filter) {
                $filter = explode('|', $filter);
                $applications->where($filter[0], $filter[1]);
            }
        }

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $applications->orderBy($orderBy, $orderDirection);
        }

        // získanie prihlášok
        $applications = $applications->get();

        return view('admin.applications-index', [
            'applications' => $applications
        ]);
    }
    public function create()
    {
        return view('create-application');
    }

    public function store()
    {
        $email['email'] = request()->email;
        $rule = array('email' => ['required', 'email', 'max:255', Rule::unique('students', 'email')]);
        $validation = Validator($email, $rule);


        if ($validation->fails()) {
            $rule1 = Rule::exists('students', 'name')->where('email', request()->email);
            $rule2 = Rule::exists('students', 'lastname')->where('email', request()->email);

            $student = Student::firstWhere('email', $email['email']);
            $rule = array('id' => 'unique:applications,id,NULL,id,id,' . $student['id'] . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id);
            $value['id'] = $student['id'];
            $validation = Validator($value, $rule);
            if ($validation->fails()) {
                dd($validation);
            } else {
                $attributes = request()->validate([
                    'name' => ['required', 'max:255', $rule1],
                    'lastname' => ['required', 'max:255', $rule2],
                    // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                    'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                    'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
                    'days' => ['required', 'integer'],
                    'time' => ['required', 'integer'],
                ]);
            }
        } else {

            $attributes = request()->validate([
                'name' => ['required', 'max:255'],
                'lastname' => ['required', 'max:255'],
                // 'email' => 'unique:applications,email,NULL,id,email,' . request()->email . ',academy_id,' . request()->academy_id . ',coursetype_id,' . request()->coursetype_id,
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'coursetype_id' => ['required', 'integer', Rule::exists('course_types', 'id')],
                'days' => ['required', 'integer'],
                'time' => ['required', 'integer'],
            ]);

            $students_a['name'] = request()->name;
            $students_a['lastname'] = request()->lastname;
            $students_a['email'] = request()->email;

            $student = Student::create([
                'name' => $students_a['name'],
                'lastname' => $students_a['lastname'],
                'email' => $students_a['email']
            ]);

            // $student=Student::firstWhere('email',$email['email']);
        }


        Application::create([
            'student_id' => $student['id'],
            'academy_id' => $attributes['academy_id'],
            'coursetype_id' => $attributes['coursetype_id'],
            'days' => $attributes['days'],
            'time' => $attributes['time']
        ]);

        return back();
    }
    protected function sort($sort_by,$types,$lastApplications){
        switch ($sort_by) {
            case 'oldest':
                $types = $types->sortBy(function ($name, $id) use ($lastApplications) {
                    return $lastApplications[$id] ?? null;
                });
                return $types;
                break;
            case 'most_applicants':
                $types = $types->sortByDesc(function ($name, $id) use ($lastApplications) {
                    return count(Application::where('coursetype_id', $id)->get());
                });
                return $types;
                break;
            case 'less_applicants':
                $types = $types->sortBy(function ($name, $id) use ($lastApplications) {
                    return count(Application::where('coursetype_id', $id)->get());
                });
                return $types;
                break;
            default:
                $types = $types->sortByDesc(function ($name, $id) use ($lastApplications) {
                    return $lastApplications[$id] ?? null;
                });
                return $types;
                break;
        }
    }
}

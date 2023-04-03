<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ApplicationController extends Controller
{
    public function create()
    {
        return view('create-application');
    }

    public function store()
    {
        $email['email'] = request()->email;
        $rule = array('email' => Rule::unique('applications', 'email'));
        $email = Validator($email, $rule);

        $rule1=null;
        $rule2=null;
        if($email->fails())
        {
            $rule1 = Rule::exists('applications', 'name')->where('email', request()->email);
            $rule2 = Rule::exists('applications', 'lastname')->where('email', request()->email);
        }
            
        
        $attributes = request()->validate([
            'name' => ['required', 'max:255',$rule1],
            'lastname' => ['required', 'max:255',$rule2],
            'email' => 'required|email|max:255|unique:applications,email,NULL,id,email,'.request()->email.',academy_id,'.request()->academy_id.',coursetype_id,'.request()->coursetype_id,
            'academy_id' => ['required', 'integer',Rule::exists('academies', 'id')],
            'coursetype_id' => ['required', 'integer',Rule::exists('course_types', 'id')],
            'days' => ['required', 'integer'],
            'time' => ['required', 'integer'],
        ]);

        Application::create($attributes);

        return back();
    }
}

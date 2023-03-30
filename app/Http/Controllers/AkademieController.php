<?php

namespace App\Http\Controllers;

use App\Models\Akademie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AkademieController extends Controller
{
    public function create(){
        return view('admin.form');
    }

    public function store(){

        $attributes = request()->validate([
            'nazov' => ['required', 'max:255',Rule::unique('akademies', 'nazov')]
        ]);

        Akademie::create($attributes);

        return redirect('/admin');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Prihlasky;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrihlaskyController extends Controller
{
    public function create(){
        return view('form');
    }

    public function store(){


        $attributes = request()->validate([
            'meno' => ['required', 'max:255'],
            'priezvisko' => ['required', 'max:255'],
        'email' => ['required','email','max:255'/*,Rule::unique('prihlaskies','email')*/],
            'akademia_id' => ['required','integer'],
            'typkurzu_id' => ['required','integer'],
            'dni' => ['required','integer'],
            'cas' => ['required','integer'],
        ]);

        Prihlasky::create($attributes);

        return redirect('/');
    }
}

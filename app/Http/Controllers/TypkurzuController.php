<?php

namespace App\Http\Controllers;

use App\Models\Typkurzu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypkurzuController extends Controller
{
    public function create(){
        return view('admin.kurz');
    }

    public function store(){
        $attributes = request()->validate([
            'nazov' => ['required', 'max:255',Rule::unique('typkurzus','nazov')],
            'akademies_id' => ['required', 'integer', Rule::exists('akademies','id')],
            'min' => ['required','integer','lte:max'],
            'max' => ['required','integer'],
        ]);

        Typkurzu::create($attributes);

        return redirect('/admin/kurz');
    }
}

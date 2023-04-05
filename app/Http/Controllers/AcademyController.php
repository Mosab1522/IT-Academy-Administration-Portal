<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademyController extends Controller
{
    public function index()
    {   
        return view('admin.index', [
            'academies' => Academy::with('coursetypes')->get()
        ]);
    }

    public function create()
    {
        return view('admin.create-academy');
    }

    public function store()
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:255', Rule::unique('academies', 'name')]
        ]);

        Academy::create($attributes);

        return back();
    }
}

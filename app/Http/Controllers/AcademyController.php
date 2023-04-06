<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademyController extends Controller
{
    public function index()
    {
        return view('admin.academies-index', [
            'academies' => Academy::with('coursetypes')->get()
        ]);
    }

    public function show(Academy $academy,)
    {
        return view('admin.academies-show', ['academy' => $academy]);
    }

    public function create()
    {
        return view('admin.academies-create');
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

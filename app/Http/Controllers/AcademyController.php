<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademyController extends Controller
{
    public function index(Request $request)
    {
         if ($request->filled('search')) {
            $academies = Academy::with(['coursetypes', 'applications'])->where('name', 'like', '%' . $request->input('search') . '%');
    
        } else {
            $academies = Academy::with(['coursetypes', 'applications']);
        }

        // dd($request->input('search'));
        // spracovanie filtrov

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $academies->orderBy($orderBy, $orderDirection);
        } else {
            $academies->orderBy('created_at', 'desc');
        }

        $academies = $academies->get();

        return view('admin.academies-index', [
            'academies' => $academies
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
    public function update(Academy $academy)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255', Rule::unique('academies', 'name')->ignore($academy)]
        ]);
        $academy->update($attributes);

        return back();
    }

    public function destroy(Academy $academy)
    {
        $academy->delete();

        return back()->with('success', 'Post deleted successfully');
    }
}

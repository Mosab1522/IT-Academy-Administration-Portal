<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;


class CourseTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $coursetypes = CourseType::with(['academy', 'applications','instructors'])->where('name', 'like', '%' . $request->input('search') . '%')
                ->orwhereHas('academy', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
        } else {
            $coursetypes = CourseType::with(['academy', 'applications','instructors']);
        }

        // dd($request->input('search'));
        // spracovanie filtrov
        if ($request->filled('academy_id')) {
            $filter = $request->input('academy_id');
            $coursetypes->where('academy_id', $filter);
        }

        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $coursetypes->orderBy($orderBy, $orderDirection);
        } else {
            $coursetypes->orderBy('created_at', 'desc');
        }

        $coursetypes = $coursetypes->get();

        return view('admin.coursetypes-index', [
            'coursetypes' => $coursetypes
        ]);
    }
    public function create()
    {
        return view('admin.coursetypes-create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255', Rule::unique('course_types', 'name')],
            'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
            'min' => ['required', 'integer', 'lte:max'],
            'max' => ['required', 'integer', 'gte:min'],
        ]);

        CourseType::create($attributes);

        return back();
    }
}

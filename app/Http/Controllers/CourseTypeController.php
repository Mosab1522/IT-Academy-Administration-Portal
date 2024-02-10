<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Request as IlluminateRequest;
use Illuminate\Support\Str;


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

    public function show(Coursetype $coursetype)
    {
        return view('admin.coursetypes-show', ['coursetype' => $coursetype]);
    }

    public function create()
    {
        return view('admin.coursetypes-create');
    }

    public function store()
    {
        
        if(request()->type == 2)
        {
            $attributes = request()->validate([
                'name' => 'required|max:255|unique:course_types,name,NULL,id,type,0',
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'type' => ['required', 'integer', 'in:0,1,2'],
                'min' => ['required', 'integer', 'lte:max'],
                'max' => ['required', 'integer', 'gte:min'],
            ]);
            $attributes = request()->validate([
                'name' => 'required|max:255|unique:course_types,name,NULL,id,type,1',
                'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
                'type' => ['required', 'integer', 'in:0,1,2'],
                'min' => ['required', 'integer', 'lte:max'],
                'max' => ['required', 'integer', 'gte:min'],
            ]);
            $attributes['type'] = 0;
            CourseType::create($attributes);
            $attributes['type'] = 1;
            CourseType::create($attributes);
        }else
        {
            $attributes = request()->validate([
            'name' => 'required|max:255|unique:course_types,name,NULL,id,type,' . request()->type,
            'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
            'type' => ['required', 'integer', 'in:0,1,2'],
            'min' => ['required', 'integer', 'lte:max'],
            'max' => ['required', 'integer', 'gte:min'],
        ]);
             CourseType::create($attributes);
        }
       

        if (Str::endsWith(url()->previous(), '?pridat'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_c', 'Úspešne vytvorené');
        }

        return back()->with('success_c', 'Úspešne vytvorené');
    }
    public function update(Coursetype $coursetype)
    {
        $academy = Academy::with(['coursetypes', 'applications'])
        ->where('id', '=', request()->academy_id)->first();

        // if ($academy == null) {
        //     dd(request()->all());
        // };

        // request()->merge(['academy_id'  => $academy['id']]); 
        
       
        

        $attributes = request()->validate([
            'name' => 'required|max:255|unique:course_types,name,' . $coursetype->id . ',id,type,' . request()->type,
            'type' => ['required', 'integer', 'in:0,1'],
            'academy_id' => ['required', 'integer', Rule::exists('academies', 'id')],
            'min' => ['required', 'integer', 'lte:max'],
            'max' => ['required', 'integer', 'gte:min'],
        ]);

        $coursetype->update($attributes); 
        
        if (Str::endsWith(url()->previous(), '?pridat'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_u', 'Úspešne aktualizované');
        }

        return back()->with('success_u', 'Úspešne aktualizované');
    }

    public function destroy(CourseType $coursetype)
    {   
        
        $coursetype->delete();

        if (Str::endsWith(url()->previous(), '?pridat'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_d', 'Úspešne vymazané');
        }
        
        return back()->with('success_d', 'Úspešne vymazané');
    }
}

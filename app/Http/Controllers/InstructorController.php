<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class InstructorController extends Controller
{

    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $instructors = Instructor::with(['coursetypes', 'login'])
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('lastname', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('email', 'like', '%' . $request->input('search') . '%');
                });
                // ->where(function ($query) use ($request) {
                //     if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
                //         $filter = $request->input('coursetype_id');
                //         $query->whereHas('coursetypes', function (Builder $query) use ($filter) {
                //             $query->where('id', 'like', '%' . $filter . '%');
                //         })
                //             ->whereHas('coursetypes', function (Builder $query) {
                //                 $query->has('instructors');
                //             })
                //             ->whereHas('coursetypes.academy', function (Builder $query) use ($request) {
                //                 $query->where('id', 'like', '%' . $request->input('academy_id') . '%');
                //             });
                //     } else if ($request->filled('academy_id')) {
                //         $filter = $request->input('academy_id');
                //         $query->whereHas('coursetypes', function (Builder $query) use ($filter) {
                //             $query->whereHas('academy', function ($query) use ($filter) {
                //                 $query->where('id', 'like', '%' . $filter . '%');
                //             });
                //         })->whereHas('coursetypes', function (Builder $query) {
                //             $query->has('instructors');
                //         });
                //     }
                // });
        } else {
            $instructors = Instructor::with(['coursetypes', 'login']);
            // if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
            //     $filter = $request->input('coursetype_id');
            //     $instructors = $instructors
            //         ->whereHas('coursetypes', function (Builder $query) use ($filter) {
            //             $query->where('id', 'like', '%' . $filter . '%');
            //         })
            //         ->whereHas('coursetypes', function (Builder $query) {
            //             $query->has('instructors');
            //         })
            //         ->whereHas('coursetypes.academy', function (Builder $query) use ($request) {
            //             $query->where('id', 'like', '%' . $request->input('academy_id') . '%');
            //         });
            // } else if ($request->filled('academy_id')) {
            //     $filter = $request->input('academy_id');
            //     $instructors = $instructors
            //         ->whereHas('coursetypes', function (Builder $query) use ($filter) {
            //             $query->whereHas('academy', function ($query) use ($filter) {
            //                 $query->where('id', 'like', '%' . $filter . '%');
            //             });
            //         })
            //         ->whereHas('coursetypes', function (Builder $query) {
            //             $query->has('instructors');
            //         });
            // }
        }

        if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
            $filter = $request->input('coursetype_id');
            $instructors = $instructors
                ->whereHas('coursetypes', function (Builder $query) use ($filter) {
                    $query->where('id', 'like', '%' . $filter . '%');
                })
                ->whereHas('coursetypes', function (Builder $query) {
                    $query->has('instructors');
                })
                ->whereHas('coursetypes.academy', function (Builder $query) use ($request) {
                    $query->where('id', 'like', '%' . $request->input('academy_id') . '%');
                });
        } else if ($request->filled('academy_id')) {
            $filter = $request->input('academy_id');
            $instructors = $instructors
                ->whereHas('coursetypes', function (Builder $query) use ($filter) {
                    $query->whereHas('academy', function ($query) use ($filter) {
                        $query->where('id', 'like', '%' . $filter . '%');
                    });
                })
                ->whereHas('coursetypes', function (Builder $query) {
                    $query->has('instructors');
                });
        }










        //   dd($request->input('coursetype_id'));
        // spracovanie filtrov
        // $instructors = $instructors->get();

        // dd($instructors);


        // zoradenie
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            $orderDirection = $request->input('orderDirection');
            $instructors->orderBy($orderBy, $orderDirection);
        } else {
            $instructors->orderBy('created_at', 'desc');
        }


        $instructors = $instructors->get();

        // dd($instructors);

        return view('admin.instructors-index', [
            'instructors' => $instructors
        ]);
    }
    public function create()
    {
        return view('admin.instructors-create');
    }

    public function store()
    {
        // dd(request()->all());

        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('instructors', 'email')],
            'coursetypes_id' => ['array'],
            'coursetypes_id.*' => 'distinct|exists:course_types,id'

        ]);

        $instructor = Instructor::create([
            'name' => $attributes['name'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email']
        ]);
        if (request()->coursetypes_id) {
            foreach (request()->coursetypes_id as $coursetype_id) {
                $coursetype = CourseType::find($coursetype_id);
                $instructor->coursetypes()->save($coursetype);
            }
        }

        session(['instructor_id' => $instructor['id']]);

        return redirect('/admin/login/create');
    }
}

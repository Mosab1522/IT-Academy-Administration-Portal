<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;


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



        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'photo' => ['image'],
            'email' => ['required', 'email', 'max:255', Rule::unique('instructors', 'email'), Rule::unique('instructors', 'sekemail')],
            'sekemail' => ['email', 'nullable', 'different:email', Rule::unique('instructors', 'email'), Rule::unique('instructors', 'sekemail')],
            'telephone' => [
                'nullable',
                'regex:/^\+421\s?\d{3}\s?\d{3}\s?\d{3}$|^09\d{2}\s?\d{3}\s?\d{3}$/', Rule::unique('instructors', 'telephone')
            ],
            'coursetypes_id' => ['array',],
            'coursetypes_id.*' => 'nullable|distinct|exists:course_types,id'

        ]);
        if (empty($attributes['telephone'])) {
            $attributes['telephone'] = NULL;
        } else {
            $attributes['telephone'] = $this->normalizePhoneNumber(request()->telephone);

            $rule = array('telephone' => [Rule::unique('instructors', 'telephone')]);
            $validation = Validator($attributes, $rule);

            if ($validation->fails()) {
                throw ValidationException::withMessages(['telephone' => 'Toto telefonné číslo sa už používa.']);
            }
        }




        //  dd($attributes);


        // if($attributes['email'] == $attributes['sekemail'])
        // {
        //     throw ValidationException::withMessages(['email' => 'Zadali ste totožné emaily.']);
        // }
       
        $attributes['photo'] ??= NULL;
        //  dd($attributes);
        if ($attributes['photo']) {
            $attributes['photo'] = request()->file('photo')->store('photos');
        }

        $instructor = Instructor::create([
            'name' => $attributes['name'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email'],
            'sekemail' => $attributes['sekemail'],
            'photo' => $attributes['photo'],
            'telephone' => $attributes['telephone']
        ]);
        if (request()->coursetypes_id) {
            foreach (request()->coursetypes_id as $coursetype_id) {
                if ($coursetype_id != 0) {
                    $coursetype = CourseType::find($coursetype_id);
                    $instructor->coursetypes()->save($coursetype);
                }
            }
        }

        session(['instructor_id' => $instructor['id']]);

        return redirect('/admin/login/create');
    }

    protected function normalizePhoneNumber($phoneNumber)
    {
        // Remove non-digit characters and leading "0" from local numbers
        $normalizedNumber = preg_replace('/\D/', '', $phoneNumber);

        // If the number starts with "0", replace it with the country code "+421"
        if (strpos($normalizedNumber, '0') === 0) {
            $normalizedNumber = '+421' . substr($normalizedNumber, 1);
        } else if (strpos($normalizedNumber, '0') === '+') {
            $normalizedNumber = '+' . substr($normalizedNumber, 0);
        } else {
            $normalizedNumber = null;
        }

        return $normalizedNumber;
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\Academy;
use App\Models\CourseType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Eager load related models to reduce queries
        // $query = Application::with(['academy', 'coursetype', 'student']);

        // // Apply filters based on request parameters using "when"
        // $query->when($request->filled('academy_id'), function ($q) use ($request) {
        //     $q->where('academy_id', $request->academy_id);
        // });

        // $query->when($request->filled('coursetype_id'), function ($q) use ($request) {
        //     $q->where('coursetype_id', $request->coursetype_id);
        // });

        // $query->when($request->filled('search'), function ($q) use ($request) {
        //     $q->whereHas('student', function ($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->search}%")
        //           ->orWhere('lastname', 'like', "%{$request->search}%")
        //           ->orWhere('email', 'like', "%{$request->search}%");
        //     })->orWhereHas('academy', function ($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->search}%");
        //     })->orWhereHas('coursetype', function ($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->search}%");
        //     });
        // });

        // $applications = $query->orderByDesc('created_at')->get();

        // // Group by 'coursetype.name' and 'academy.name' after retrieval
        // $groupedApplications = $applications->groupBy(['coursetype.name', 'academy.name']);

        // $academies = Academy::all();


        $query = CourseType::with(['academy','applications']);


        $query->when($request->filled('academy_id'), function ($q) use ($request) {
            $q->where('academy_id', $request->academy_id);
        });

        $query->when($request->filled('coursetype_id'), function ($q) use ($request) {
            $q->where('id', $request->coursetype_id);
        });

        if ($request->input('orderBy') === 'most_applicants' || $request->input('orderBy') === 'less_applicants') {
            $query->withCount('applications')
                  ->orderBy('applications_count', $request->input('orderBy') === 'most_applicants' ? 'desc' : 'asc');
        }
        

        if ($request->input('orderBy') === 'latest') { $query = $query->orderByDesc(function ($query) {
            $query->select('created_at')
            ->from('applications')
            ->whereColumn('coursetype_id', 'course_types.id')
            ->latest()
            ->limit(1);
            });
        }
        if ( $request->input('orderBy') === 'oldest') { $query = $query->orderBy(function ($query) {
            $query->select('created_at')
            ->from('applications')
            ->whereColumn('coursetype_id', 'course_types.id')
            ->latest()
            ->limit(1);
            });
        }

        $query->when($request->filled('search'), function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")  // Search in CourseType name
              ->orWhereHas('academy', function ($query) use ($request) {
                  $query->where('name', 'like', "%{$request->search}%");  // Search in related Academy name
              })
              ->orWhereHas('applications.student', function ($query) use ($request) {
                  // Search in Student name and lastname related through Applications
                  $query->where('name', 'like', "%{$request->search}%")
                        ->orWhere('lastname', 'like', "%{$request->search}%");
              });
        });

        if( $request->input('orderBy') )
        {
           
        }else{
            $query = $query->orderByDesc(function ($query) {
                $query->select('created_at')
                ->from('applications')
                ->whereColumn('coursetype_id', 'course_types.id')
                ->latest()
                ->limit(1);
                });
        }

        $coursetypes = $query->get();

        return view('admin.dashboard-index', [
            'coursetypes' => $coursetypes
        ]);
    }
    public function calendar(Request $request)

    {
        return view('admin.calendar-index', [
           
        ]);
    }

}

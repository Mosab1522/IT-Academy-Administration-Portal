<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $applications = Application::with(['academy', 'coursetype', 'student'])
        //     ->orderByDesc('created_at')
        //     ->groupBy(['coursetype.name', 'academy.name']);

        $sort_by = $request->input('sort_by');

        $lastApplications = null;
        if (Application::all()->count() > 0) {
            $lastApplications = Application::select(DB::raw('MAX(created_at) as last_created_at, coursetype_id'))
                ->groupBy('coursetype_id')
                ->pluck('last_created_at', 'coursetype_id');
        }

        if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
            $filter = $request->input('coursetype_id');
            $applications=Application::with(['academy', 'coursetype', 'student'])->where('coursetype_id', $filter);
        } else if ($request->filled('academy_id')) {
            $filter = $request->input('academy_id');
            $applications=Application::with(['academy', 'coursetype', 'student'])->where('academy_id', $filter);
        }
        else{
            $applications=Application::with(['academy', 'coursetype', 'student']);
        }


        if ($request->filled('search')) {
            $applications = $applications
                ->whereHas('student', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%')->orWhere('lastname', 'like', '%' . $request->input('search') . '%')->orWhere('email', 'like', '%' . $request->input('search') . '%');
                })->orWhereHas('academy', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                })->orWhereHas('coursetype', function (Builder $query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('search') . '%');
                });
        } 
        // else {
        //     $applications = $applications;
        // }
        
         
        if ($request->filled('academy_id') && $request->filled('coursetype_id')) {
            $filter = $request->input('coursetype_id');
            $applications=$applications->where('coursetype_id', $filter);
        } else if ($request->filled('academy_id')) {
            $filter = $request->input('academy_id');
            $applications=$applications->where('academy_id', $filter);
        }

        $applications = $applications
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(['coursetype.name', 'academy.name']);
        
        $types = CourseType::orderBy('name')
            ->has('applications')
            ->pluck('name', 'id')
            ->filter(function ($name, $id) use ($applications) {
                return $applications->has($name);
            });

        // $types = CourseType::orderBy('name')->has('applications')->pluck('name', 'id');

        $types = $this->sort($sort_by, $types, $lastApplications);

        return view('admin.dashboard-index', compact('applications', 'lastApplications', 'types'));
    }

    protected function sort($sort_by, $types, $lastApplications)
    {
        switch ($sort_by) {
            case 'oldest':
                $types = $types->sortBy(function ($name, $id) use ($lastApplications) {
                    return $lastApplications[$id] ?? null;
                });
                return $types;
                break;
            case 'most_applicants':
                $types = $types->sortByDesc(function ($name, $id) use ($lastApplications) {
                    return count(Application::where('coursetype_id', $id)->get());
                });
                return $types;
                break;
            case 'less_applicants':
                $types = $types->sortBy(function ($name, $id) use ($lastApplications) {
                    return count(Application::where('coursetype_id', $id)->get());
                });
                return $types;
                break;
            default:
                $types = $types->sortByDesc(function ($name, $id) use ($lastApplications) {
                    return $lastApplications[$id] ?? null;
                });
                return $types;
                break;
        }
    }
}

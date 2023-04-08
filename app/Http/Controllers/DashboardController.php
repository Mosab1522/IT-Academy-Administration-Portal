<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\CourseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by');
    
        $lastApplications = Application::select(DB::raw('MAX(created_at) as last_created_at, coursetype_id'))
            ->groupBy('coursetype_id')
            ->pluck('last_created_at', 'coursetype_id');
    
        $types = CourseType::orderBy('name')->pluck('name', 'id');
    
        $types=$this->sort($sort_by,$types,$lastApplications);
    
        $applications = Application::with(['academy', 'coursetype', 'student'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(['coursetype.name', 'academy.name']);
    
        return view('admin.dashboard-index', compact('applications', 'lastApplications', 'types'));
    }

    protected function sort($sort_by,$types,$lastApplications){
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

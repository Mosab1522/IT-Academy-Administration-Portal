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
        $query = Application::with(['academy', 'coursetype', 'student']);

        // Apply filters based on request parameters using "when"
        $query->when($request->filled('academy_id'), function ($q) use ($request) {
            $q->where('academy_id', $request->academy_id);
        });

        $query->when($request->filled('coursetype_id'), function ($q) use ($request) {
            $q->where('coursetype_id', $request->coursetype_id);
        });

        $query->when($request->filled('search'), function ($q) use ($request) {
            $q->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('lastname', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            })->orWhereHas('academy', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->orWhereHas('coursetype', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        });

        $applications = $query->orderByDesc('created_at')->get();

        // Group by 'coursetype.name' and 'academy.name' after retrieval
        $groupedApplications = $applications->groupBy(['coursetype.name', 'academy.name']);

        $academies = Academy::all();
        $coursetypes = CourseType::all();

        return view('admin.dashboard-index', compact('groupedApplications', 'academies', 'coursetypes'));
    }
}

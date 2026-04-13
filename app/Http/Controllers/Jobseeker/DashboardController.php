<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;

class DashboardController extends Controller
{
    public function index()
    {
        $applicationCount = Application::where('user_id', auth()->id())->count();
        $recentApplications = Application::where('user_id', auth()->id())
            ->with('jobListing')
            ->latest()
            ->take(5)
            ->get();

        //jobs the account hasnt applied to yet
        $recentJobs = JobListing::where('status', 'open')
            ->whereDoesntHave('applications', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->take(5)
            ->get();

        return view('jobseeker.dashboard', compact('applicationCount', 'recentApplications', 'recentJobs'));
    }
}
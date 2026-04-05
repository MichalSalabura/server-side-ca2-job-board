<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;

class DashboardController extends Controller
{

    public function index()
    {
        $jobCount = JobListing::where('user_id', auth()->id())->count();
        $recentJobs = JobListing::where('user_id', auth()->id())->latest()->take(5)->get();

        // New applications in last 7 days across all employer's listings
        $newApplications = \App\Models\Application::whereHas('jobListing', function ($q) {
            $q->where('user_id', auth()->id());
        })->where('created_at', '>=', now()->subDays(7))->count();

        return view('employer.dashboard', compact('jobCount', 'recentJobs', 'newApplications'));
    }
}
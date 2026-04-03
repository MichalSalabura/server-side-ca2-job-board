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

        return view('employer.dashboard', compact('jobCount', 'recentJobs'));
    }
}
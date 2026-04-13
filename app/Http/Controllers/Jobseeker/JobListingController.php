<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function browse(Request $request)
    {
        $query = JobListing::where('status', 'open');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Location filter
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Type filter
        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }

        $jobs = $query->latest()->paginate(10);

        return view('jobseeker.job-listings.browse', compact('jobs'));
    }

    public function show(JobListing $jobListing)
    {
        // Check if user already applied
        $hasApplied = $jobListing->applications()->where('user_id', auth()->id())->exists();

        return view('jobseeker.job-listings.show', compact('jobListing', 'hasApplied'));
    }
}
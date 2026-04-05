<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;

class ApplicationController extends Controller
{
    public function index(JobListing $jobListing)
    {
        if ($jobListing->user_id !== auth()->id()) {
            abort(403);
        }

        $applications = $jobListing->applications()->with('user')->get();

        return view('employer.applications.index', compact('jobListing', 'applications'));
    }
}
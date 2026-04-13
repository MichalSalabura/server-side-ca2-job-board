<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\Storage;

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

    public function viewCV(JobListing $jobListing, Application $application)
    {
        // checks it belongs to the right employer
        if ($jobListing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to job listing.');
        }

        // checks that it belongs to this job listing
        if ($application->job_listing_id !== $jobListing->id) {
            abort(403, 'Application does not belong to this job listing.');
        }

        // check if the cv file exists
        if (!$application->cv_path || !Storage::disk('public')->exists($application->cv_path)) {
            abort(404, 'CV file not found.');
        }

        // finds the file path
        $filePath = Storage::disk('public')->path($application->cv_path);

        // sends back the file
        return response()->file($filePath);
    }
}
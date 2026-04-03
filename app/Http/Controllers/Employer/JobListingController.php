<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('user_id', auth()->id())->latest()->get();
        return view('employer.job-listings.index', compact('jobs'));
    }

    public function create()
    {
        return view('employer.job-listings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:full-time,part-time,contract,internship'],
        ]);

        JobListing::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'type' => $request->type,
        ]);

        return redirect()->route('job-listings.index')->with('success', 'Job listing created successfully.');
    }

    public function show(JobListing $jobListing)
    {
        return view('employer.job-listings.show', compact('jobListing'));
    }

    public function edit(JobListing $jobListing)
    {
        return view('employer.job-listings.edit', compact('jobListing'));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:full-time,part-time,contract,internship'],
        ]);

        $jobListing->update($request->all());

        return redirect()->route('job-listings.index')->with('success', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $jobListing)
    {
        $jobListing->delete();
        return redirect()->route('job-listings.index')->with('success', 'Job listing deleted.');
    }
}
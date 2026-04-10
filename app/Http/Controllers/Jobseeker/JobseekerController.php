<?php
namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobseekerController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->jobseekerProfile;
        return view('jobseeker.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'display_email' => ['required', 'string', 'email', 'max:255', 'unique:jobseekers,display_email,' . auth()->user()->jobseekerProfile->id],
        ]);

        auth()->user()->jobseekerProfile->update($request->all());

        return redirect()->route('jobseeker.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function apply(Request $request, JobListing $jobListing)
    {
        $request->validate([
            'cover_letter' => ['required', 'string', 'max:1000'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        // Check if user already applied
        $existingApplication = Application::where('job_listing_id', $jobListing->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied to this job.');
        }

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        Application::create([
            'job_listing_id' => $jobListing->id,
            'user_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}
<?php
namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
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
}
<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerProfileController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->employerProfile;
        return view('employer.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        auth()->user()->employerProfile->update($request->all());

        return redirect()->route('employer.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
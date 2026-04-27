<?php
namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Pail\ValueObjects\Origin\Console;

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

        $coords = $this->geocodeLocation($request->location);

        JobListing::create([
            'user_id' => auth()->id(),
            'company_name' => $request->company_name,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'latitude' => $coords['latitude'],
            'longitude' => $coords['longitude'],
            'salary' => $request->salary,
            'type' => $request->type,
        ]);

        return redirect()->route('job-listings.index')->with('success', 'Job listing created successfully.');
    }

    public function show(JobListing $jobListing)
    {
        if ($jobListing->user_id !== auth()->id()) {
            abort(403);
        }
        return view('employer.job-listings.show', compact('jobListing'));
    }

    public function edit(JobListing $jobListing)
    {
        if ($jobListing->user_id !== auth()->id()) {
            abort(403);
        }
        return view('employer.job-listings.edit', compact('jobListing'));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        if ($jobListing->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:full-time,part-time,contract,internship'],
        ]);

        $coords = $this->geocodeLocation($request->location);

        $jobListing->update(array_merge($request->all(), [
            'latitude' => $coords['latitude'],
            'longitude' => $coords['longitude'],
        ]));

        return redirect()->route('job-listings.index')->with('success', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $jobListing)
    {
        if ($jobListing->user_id !== auth()->id()) {
            abort(403);
        }
        $jobListing->delete();
        return redirect()->route('job-listings.index')->with('success', 'Job listing deleted.');
    }

    private function geocodeLocation(string $location): array
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'TechHire/1.0'
            ])->withoutVerifying()->get('https://nominatim.openstreetmap.org/search', [
                        'q' => $location,
                        'format' => 'json',
                        'limit' => 1,
                    ]);

            $data = $response->json();

            if (!empty($data) && isset($data[0]['lat'])) {
                return [
                    'latitude' => $data[0]['lat'],
                    'longitude' => $data[0]['lon'],
                ];
            }
        } catch (\Exception $e) {
            // fail silently
        }

        return ['latitude' => null, 'longitude' => null];
    }
}
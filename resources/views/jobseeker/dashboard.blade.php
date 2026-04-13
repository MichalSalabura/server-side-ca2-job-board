@extends('layouts.jobseeker')
@section('title', 'Dashboard')

@section('content')
    <h5 class="fw-bold mb-3">Your Applications</h5>

    {{-- common search bar --}}
    <div class="input-group mb-3">
        <span class="input-group-text bg-white"><i>🔍</i></span>
        <input type="text" class="form-control" placeholder="Search applications...">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- amount of job listings the job seeker applied to --}}
    <p class="text-muted">Total applications: <strong>{{ $applicationCount }}</strong></p>

    {{-- displaying those applications --}}
    <div class="row g-3 mb-4">
        @if($recentApplications->isEmpty())
            <div class="col-12">
                <p class="text-muted text-center">No applications yet.</p>
            </div>
        @else
            @foreach($recentApplications as $application)
                <div class="col-6">
                    <div class="job-card h-100">
                        <p class="fw-bold mb-1" style="font-size:14px">{{ $application->jobListing->title }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $application->jobListing->company_name }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $application->jobListing->location }}</p>
                        <span class="badge mb-2" style="background-color: var(--purple); font-size:10px">{{ $application->jobListing->type }}</span>
                        <div class="mt-2">
                            <small class="text-muted">Applied {{ $application->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <h5 class="fw-bold mb-3">Recent Job Listings</h5>

    {{-- new job listings made --}}
    <div class="row g-3">
        @if($recentJobs->isEmpty())
            <div class="col-12">
                <p class="text-muted text-center">No new job listings.</p>
            </div>
        @else
            @foreach($recentJobs as $job)
                <div class="col-6">
                    <div class="job-card h-100">
                        <p class="fw-bold mb-1" style="font-size:14px">{{ $job->title }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $job->company_name }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $job->location }}</p>
                        <span class="badge mb-2" style="background-color: var(--purple); font-size:10px">{{ $job->type }}</span>
                        <div class="mt-2 d-flex gap-1">
                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-sm btn-purple"
                                style="font-size:11px">View & Apply</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
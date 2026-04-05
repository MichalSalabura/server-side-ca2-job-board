@extends('layouts.employer')
@section('title', 'Dashboard')

@section('content')
    <h5 class="fw-bold mb-3">Your Listings</h5>

    {{-- Search bar --}}
    <div class="input-group mb-3">
        <span class="input-group-text bg-white"><i>🔍</i></span>
        <input type="text" class="form-control" placeholder="Search listings...">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p class="text-muted">Total listings: <strong>{{ $jobCount }}</strong></p>

    @if($newApplications > 0)
        <div class="alert mb-3" style="background-color: #efe9ff; border-left: 4px solid var(--purple); border-radius: 8px;">
            <p class="mb-0" style="font-size:13px; color: var(--purple)">
                🔔 You have <strong>{{ $newApplications }}</strong> new application(s) in the last 7 days.
            </p>
        </div>
    @endif

    {{-- Job cards grid --}}
    <div class="row g-3">
        @if($recentJobs->isEmpty())
            <div class="col-12">
                <p class="text-muted text-center">No job listings yet.</p>
            </div>
        @else
            @foreach($recentJobs as $job)
                <div class="col-6">
                    <div class="job-card h-100">
                        <p class="fw-bold mb-1" style="font-size:14px">{{ $job->title }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $job->location }}</p>
                        <span class="badge mb-2" style="background-color: var(--purple); font-size:10px">{{ $job->type }}</span>
                        <div class="mt-2 d-flex gap-1">
                            <a href="{{ route('job-listings.edit', $job) }}" class="btn btn-sm btn-outline-purple"
                                style="font-size:11px">Edit</a>
                            <a href="{{ route('job-listings.show', $job) }}" class="btn btn-sm btn-purple"
                                style="font-size:11px">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('job-listings.create') }}" class="btn btn-purple w-100">+ Post New Job</a>
    </div>
@endsection
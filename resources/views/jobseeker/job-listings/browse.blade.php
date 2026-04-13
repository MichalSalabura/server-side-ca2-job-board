@extends('layouts.jobseeker')
@section('title', 'Browse Jobs')

@section('content')
    <h5 class="fw-bold mb-3">Available Job Listings</h5>

    {{-- job search and filter --}}
    <div class="card p-3 mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Search jobs..." id="searchInput">
            </div>
            <div class="col-md-3">
                <select class="form-select" id="locationFilter">
                    <option value="">All Locations</option>
                    <option value="remote">Remote</option>
                    <option value="hybrid">Hybrid</option>
                    <option value="onsite">On-site</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="typeFilter">
                    <option value="">All Types</option>
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="contract">Contract</option>
                    <option value="freelance">Freelance</option>
                </select>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- display job listings matching search filter --}}
    <div class="row g-3" id="jobListings">
        @forelse($jobs as $job)
            <div class="col-12 job-card">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="fw-bold mb-1">{{ $job->title }}</h6>
                        <p class="text-muted mb-1">{{ $job->company_name }}</p>
                        <p class="text-muted mb-2">{{ $job->location }}</p>
                        <p class="mb-2" style="font-size:14px">{{ Str::limit($job->description, 150) }}</p>
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge" style="background-color: var(--purple); font-size:11px">{{ $job->type }}</span>
                            @if($job->salary)
                                <span class="badge bg-secondary" style="font-size:11px">${{ is_numeric($job->salary) ? number_format($job->salary) : $job->salary }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('jobs.show', $job) }}" class="btn btn-purple">View & Apply</a>
                        <p class="text-muted mt-2" style="font-size:12px">Posted {{ $job->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted text-center">No job listings available.</p>
            </div>
        @endforelse
    </div>

    {{-- limits jobs per page --}}
    @if($jobs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->links() }}
        </div>
    @endif
@endsection
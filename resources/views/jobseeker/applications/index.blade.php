@extends('layouts.jobseeker')
@section('title', 'My Applications')

@section('content')
    <h5 class="fw-bold mb-3">My Applications</h5>

    {{-- common search bar --}}
    <div class="input-group mb-3">
        <span class="input-group-text bg-white"><i>🔍</i></span>
        <input type="text" class="form-control" placeholder="Search applications...">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- listing applications and cover letter if there is one --}}
    <div class="row g-3">
        @forelse($applications as $application)
            <div class="col-12">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-1">{{ $application->jobListing->title }}</h6>
                            <p class="text-muted mb-1">{{ $application->jobListing->company_name }}</p>
                            <p class="text-muted mb-2">{{ $application->jobListing->location }}</p>
                            <div class="d-flex gap-2 mb-2">
                                <span class="badge" style="background-color: var(--purple); font-size:11px">{{ $application->jobListing->type }}</span>
                                <span class="badge bg-secondary" style="font-size:11px">Applied {{ $application->created_at->diffForHumans() }}</span>
                            </div>
                            @if($application->cover_letter)
                                <p class="mb-0" style="font-size:14px"><strong>Cover Letter:</strong> {{ Str::limit($application->cover_letter, 100) }}</p>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('jobs.show', $application->jobListing) }}" class="btn btn-outline-purple btn-sm">View Job</a>
                            @if($application->cv_path)
                                <a href="{{ route('jobseeker.cv.view', $application) }}" target="_blank" class="btn btn-outline-secondary btn-sm ms-2">View CV</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted text-center">You haven't applied to any jobs yet.</p>
                <a href="{{ route('job-listings.browse') }}" class="btn btn-purple">Browse Jobs</a>
            </div>
        @endforelse
    </div>

    {{-- limiting applications per page --}}
    @if($applications->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $applications->links() }}
        </div>
    @endif
@endsection
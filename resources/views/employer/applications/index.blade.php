@extends('layouts.employer')
@section('title', 'Applications')

@section('content')
    <h5 class="fw-bold mb-1">Applications</h5>
    <p class="text-muted mb-3" style="font-size:13px">{{ $jobListing->title }}</p>

    @if($applications->isEmpty())
        <div class="card p-4 text-center">
            <p class="text-muted mb-0">No applications yet for this listing.</p>
        </div>
    @else
        <p class="text-muted mb-3" style="font-size:13px">{{ $applications->count() }} application(s) received</p>

        @foreach($applications as $application)
            <div class="card p-3 mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="fw-bold mb-1" style="font-size:14px">{{ $application->user->name }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $application->user->email }}</p>
                    </div>
                    <span class="badge" style="background-color: var(--purple); font-size:10px">
                        {{ $application->created_at->diffForHumans() }}
                    </span>
                </div>

                @if($application->cover_letter)
                    <hr>
                    <p class="mb-1" style="font-size:12px"><strong>Cover Letter:</strong></p>
                    <p style="font-size:12px">{{ $application->cover_letter }}</p>
                @endif

                @if($application->cv_path)
                    <hr>
                    <a href="{{ asset('storage/' . $application->cv_path) }}" class="btn btn-outline-purple btn-sm" target="_blank">
                        View CV
                    </a>
                @endif
            </div>
        @endforeach
    @endif

    <div class="mt-3">
        <a href="{{ route('job-listings.show', $jobListing) }}" class="btn btn-outline-purple w-100">← Back to Listing</a>
    </div>
@endsection
@extends('layouts.employer')
@section('title', $jobListing->title)

@section('content')
    <div class="card p-3 mb-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
                <h5 class="fw-bold mb-1">{{ $jobListing->title }}</h5>
                <p class="text-muted mb-1" style="font-size:13px">{{ auth()->user()->employerProfile->company_name }}</p>
            </div>
            <span class="badge {{ $jobListing->status === 'open' ? 'bg-success' : 'bg-secondary' }}">
                {{ $jobListing->status }}
            </span>
        </div>

        <div class="mb-2">
            <span class="badge mb-1" style="background-color: var(--purple)">{{ $jobListing->type }}</span>
        </div>

        <div class="mb-2" style="font-size:13px">
            <p class="mb-1"><strong>Location:</strong> {{ $jobListing->location }}</p>
            <p class="mb-1"><strong>Salary:</strong> {{ $jobListing->salary ?? 'Not specified' }}</p>
        </div>

        <hr>

        <p style="font-size:13px">{{ $jobListing->description }}</p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('job-listings.edit', $jobListing) }}" class="btn btn-outline-purple w-50">Edit</a>
        <form method="POST" action="{{ route('job-listings.destroy', $jobListing) }}" class="w-50">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger w-100" style="border-radius:20px"
                onclick="return confirm('Delete this job?')">Delete</button>
        </form>
    </div>

    <div class="mt-3">
        <a href="{{ route('job-listings.index') }}" class="btn btn-outline-purple w-100">← Back to Listings</a>
    </div>
@endsection
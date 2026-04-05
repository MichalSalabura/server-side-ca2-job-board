@extends('layouts.employer')
@section('title', 'My Job Listings')

@section('content')
    <h5 class="fw-bold mb-3">My Job Listings</h5>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        @if($jobs->isEmpty())
            <div class="col-12">
                <p class="text-muted text-center">No job listings yet.</p>
            </div>
        @else
            @foreach($jobs as $job)
                <div class="col-6">
                    <div class="job-card h-100">
                        <p class="fw-bold mb-1" style="font-size:14px">{{ $job->title }}</p>
                        <p class="text-muted mb-1" style="font-size:12px">{{ $job->location }}</p>
                        <span class="badge mb-2" style="background-color: var(--purple); font-size:10px">{{ $job->type }}</span>
                        <br>
                        <span class="badge {{ $job->status === 'open' ? 'bg-success' : 'bg-secondary' }} mb-2"
                            style="font-size:10px">{{ $job->status }}</span>
                        <div class="mt-2 d-flex gap-1 flex-wrap">
                            <a href="{{ route('job-listings.show', $job) }}" class="btn btn-sm btn-purple"
                                style="font-size:11px">View</a>
                            <a href="{{ route('job-listings.edit', $job) }}" class="btn btn-sm btn-outline-purple"
                                style="font-size:11px">Edit</a>
                            <form method="POST" action="{{ route('job-listings.destroy', $job) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="font-size:11px; border-radius:20px"
                                    onclick="return confirm('Delete this job?')">Delete</button>
                            </form>
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
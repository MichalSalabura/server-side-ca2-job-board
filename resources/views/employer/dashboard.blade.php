@extends('layouts.employer')
@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ auth()->user()->name }}</p>
    </div>

    @if(isset($newApplications) && $newApplications > 0)
        <div class="alert-info-custom">
            🔔 You have <strong>{{ $newApplications }}</strong> new application(s) in the last 7 days.
        </div>
    @endif

    {{-- Stats --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
        <div class="stat-card">
            <div class="stat-number">{{ $jobCount }}</div>
            <div class="stat-label">Total Listings</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $newApplications ?? 0 }}</div>
            <div class="stat-label">New Applications</div>
        </div>
    </div>

    {{-- Recent listings --}}
    <div class="page-header">
        <h2 class="page-title" style="font-size:16px;">Recent Listings</h2>
    </div>

    @if($recentJobs->isEmpty())
        <div class="card-custom" style="text-align:center; padding: 40px 20px;">
            <p style="color: var(--text-muted); margin:0; font-size:14px;">No job listings yet.</p>
            <a href="{{ route('job-listings.create') }}" class="btn-primary-custom"
                style="margin-top:16px; display:inline-block;">
                Post Your First Job
            </a>
        </div>
    @else
        @foreach($recentJobs as $job)
            <div class="card-custom">
                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                    <div>
                        <p style="font-weight:700; font-size:14px; margin:0 0 4px;">{{ $job->title }}</p>
                        <p style="color:var(--text-muted); font-size:12px; margin:0 0 8px;">📍 {{ $job->location }}</p>
                        <div style="display:flex; gap:6px;">
                            <span class="badge-type">{{ $job->type }}</span>
                            <span class="{{ $job->status === 'open' ? 'badge-open' : 'badge-closed' }}">{{ $job->status }}</span>
                        </div>
                    </div>
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('job-listings.edit', $job) }}" class="btn-secondary-custom"
                            style="padding:6px 12px; font-size:12px;">Edit</a>
                        <a href="{{ route('job-listings.show', $job) }}" class="btn-primary-custom"
                            style="padding:6px 12px; font-size:12px;">View</a>
                    </div>
                </div>
            </div>
        @endforeach

        <a href="{{ route('job-listings.index') }}" class="btn-ghost"
            style="width:100%; text-align:center; display:block; margin-top:8px;">
            View all listings →
        </a>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('job-listings.create') }}" class="btn-primary-custom"
            style="width:100%; text-align:center; display:block; padding: 14px;">
            + Post New Job
        </a>
    </div>
@endsection
@extends('layouts.employer')
@section('title', 'My Job Listings')

@section('content')
    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h1 class="page-title">My Listings</h1>
            <p class="page-subtitle">{{ $jobs->count() }} total listings</p>
        </div>
        <a href="{{ route('job-listings.create') }}" class="btn-primary-custom">+ Post Job</a>
    </div>

    @if(session('success'))
        <div class="alert-success-custom">{{ session('success') }}</div>
    @endif

    @if($jobs->isEmpty())
        <div class="card-custom" style="text-align:center; padding: 40px 20px;">
            <p style="color: var(--text-muted); margin:0; font-size:14px;">No job listings yet.</p>
        </div>
    @else
        @foreach($jobs as $job)
            <div class="card-custom">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                    <div>
                        <p style="font-weight:700; font-size:15px; margin:0 0 3px;">{{ $job->title }}</p>
                        <p style="color:var(--text-muted); font-size:12px; margin:0;">{{ $job->company_name }} · 📍
                            {{ $job->location }}</p>
                    </div>
                    <span class="{{ $job->status === 'open' ? 'badge-open' : 'badge-closed' }}">{{ $job->status }}</span>
                </div>
                <div style="display:flex; gap:6px; margin-bottom:12px;">
                    <span class="badge-type">{{ $job->type }}</span>
                    @if($job->salary)
                        <span
                            style="background:#f0fdf4; color:#16a34a; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:600;">{{ $job->salary }}</span>
                    @endif
                </div>
                <hr class="divider" style="margin: 12px 0;">
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('job-listings.show', $job) }}" class="btn-primary-custom"
                        style="flex:1; text-align:center; padding:8px;">View</a>
                    <a href="{{ route('job-listings.edit', $job) }}" class="btn-secondary-custom"
                        style="flex:1; text-align:center; padding:8px;">Edit</a>
                    <form method="POST" action="{{ route('job-listings.destroy', $job) }}" style="flex:1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger-custom" style="width:100%; padding:8px;"
                            onclick="return confirm('Delete this job?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection
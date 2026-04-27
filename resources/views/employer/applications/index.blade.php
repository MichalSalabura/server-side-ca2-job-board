@extends('layouts.employer')
@section('title', 'Applications')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Applications</h1>
        <p class="page-subtitle">{{ $jobListing->title }} · {{ $applications->count() }} applicant(s)</p>
    </div>

    @if($applications->isEmpty())
        <div class="card-custom" style="text-align:center; padding: 40px 20px;">
            <p style="font-size:32px; margin:0 0 12px;">📭</p>
            <p style="color: var(--text-muted); margin:0; font-size:14px;">No applications yet for this listing.</p>
        </div>
    @else
        @foreach($applications as $application)
            <div class="card-custom">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                    <div>
                        <p style="font-weight:700; font-size:15px; margin:0 0 3px;">{{ $application->user->name }}</p>
                        <p style="color:var(--text-muted); font-size:12px; margin:0;">{{ $application->user->email }}</p>
                    </div>
                    <span style="font-size:11px; color:var(--text-muted);">{{ $application->created_at->diffForHumans() }}</span>
                </div>

                @if($application->cover_letter)
                    <hr class="divider">
                    <p style="font-size:11px; color:var(--text-muted); font-weight:600; margin:0 0 6px;">COVER LETTER</p>
                    <p style="font-size:13px; line-height:1.6; color:var(--text); margin:0;">{{ $application->cover_letter }}</p>
                @endif

                @if($application->cv_path)
                    <hr class="divider">
                    <a href="{{ asset('storage/' . $application->cv_path) }}" class="btn-secondary-custom" target="_blank"
                        style="font-size:12px; padding:8px 16px;">
                        📄 View CV
                    </a>
                @endif
            </div>
        @endforeach
    @endif

    <a href="{{ route('job-listings.show', $jobListing) }}" class="btn-ghost"
        style="width:100%; text-align:center; display:block; margin-top:8px;">
        ← Back to Listing
    </a>
@endsection
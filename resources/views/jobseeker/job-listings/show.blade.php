@extends('layouts.jobseeker')
@section('title', $jobListing->title)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <h4 class="fw-bold mb-3">{{ $jobListing->title }}</h4>
                <p class="text-muted mb-2">{{ $jobListing->company_name }}</p>
                <p class="text-muted mb-3">{{ $jobListing->location }}</p>

                <div class="d-flex gap-2 mb-4">
                    <span class="badge" style="background-color: var(--purple);">{{ $jobListing->type }}</span>
                    @if($jobListing->salary)
                        <span class="badge bg-secondary">${{ is_numeric($jobListing->salary) ? number_format($jobListing->salary) : $jobListing->salary }}/year</span>
                    @endif
                </div>

                <h6 class="fw-bold mb-3">Job Description</h6>
                <p class="mb-4">{{ $jobListing->description }}</p>

                {{-- check to stop multiple applications and spam --}}
                @if(!$hasApplied)
                    <button class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#applyModal">
                        Apply Now
                    </button>
                @else
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        You have already applied to this position.
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h6 class="fw-bold mb-3">Job Details</h6>
                <div class="mb-2">
                    <strong>Company:</strong> {{ $jobListing->company_name }}
                </div>
                <div class="mb-2">
                    <strong>Location:</strong> {{ $jobListing->location }}
                </div>
                <div class="mb-2">
                    <strong>Type:</strong> {{ $jobListing->type }}
                </div>
                @if($jobListing->salary)
                    <div class="mb-2">
                        <strong>Salary:</strong> ${{ is_numeric($jobListing->salary) ? number_format($jobListing->salary) : $jobListing->salary }}
                    </div>
                @endif
                {{-- date posted, important --}}
                <div class="mb-2">
                    <strong>Posted:</strong> {{ $jobListing->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>

    {{-- modal for applying --}}
    <div class="modal fade" id="applyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply for {{ $jobListing->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('job-listings.apply', $jobListing) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter</label>
                            <textarea name="cover_letter" class="form-control" rows="6" required
                                placeholder="Tell us why you're interested in this position..."></textarea>
                            @error('cover_letter')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cv" class="form-label">CV/Resume (PDF, DOC, DOCX - Max 2MB)</label>
                            <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx">
                            @error('cv')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-purple">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
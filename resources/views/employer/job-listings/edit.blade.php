@extends('layouts.employer')
@section('title', 'Edit Job')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Listing</h1>
        <p class="page-subtitle">{{ $jobListing->title }}</p>
    </div>

    <div class="card-custom">
        <form method="POST" action="{{ route('job-listings.update', $jobListing) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label-custom">Job Title</label>
                <input type="text" name="title" class="form-control-custom {{ $errors->has('title') ? 'error' : '' }}"
                    value="{{ old('title', $jobListing->title) }}" required>
                @error('title') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Company Name</label>
                <input type="text" name="company_name" class="form-control-custom"
                    value="{{ old('company_name', $jobListing->company_name) }}">
            </div>

            <div class="form-group">
                <label class="form-label-custom">Location</label>
                <input type="text" name="location" class="form-control-custom {{ $errors->has('location') ? 'error' : '' }}"
                    value="{{ old('location', $jobListing->location) }}" required>
                @error('location') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Salary <span
                        style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                <input type="text" name="salary" class="form-control-custom"
                    value="{{ old('salary', $jobListing->salary) }}">
            </div>

            <div class="form-group">
                <label class="form-label-custom">Job Type</label>
                <select name="type" class="form-control-custom {{ $errors->has('type') ? 'error' : '' }}" required>
                    <option value="full-time" {{ old('type', $jobListing->type) == 'full-time' ? 'selected' : '' }}>Full-time
                    </option>
                    <option value="part-time" {{ old('type', $jobListing->type) == 'part-time' ? 'selected' : '' }}>Part-time
                    </option>
                    <option value="contract" {{ old('type', $jobListing->type) == 'contract' ? 'selected' : '' }}>Contract
                    </option>
                    <option value="internship" {{ old('type', $jobListing->type) == 'internship' ? 'selected' : '' }}>
                        Internship</option>
                </select>
                @error('type') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Status</label>
                <select name="status" class="form-control-custom">
                    <option value="open" {{ old('status', $jobListing->status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ old('status', $jobListing->status) == 'closed' ? 'selected' : '' }}>Closed
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label-custom">Description</label>
                <textarea name="description" class="form-control-custom {{ $errors->has('description') ? 'error' : '' }}"
                    rows="5" required>{{ old('description', $jobListing->description) }}</textarea>
                @error('description') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div style="display:flex; gap:10px; margin-top:8px;">
                <a href="{{ route('job-listings.index') }}" class="btn-secondary-custom"
                    style="flex:1; text-align:center; padding:12px;">Cancel</a>
                <button type="submit" class="btn-primary-custom" style="flex:1; padding:12px;">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.employer')
@section('title', 'Post a Job')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Post a New Job</h1>
        <p class="page-subtitle">Fill in the details below</p>
    </div>

    <div class="card-custom">
        <form method="POST" action="{{ route('job-listings.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label-custom">Job Title</label>
                <input type="text" name="title" class="form-control-custom {{ $errors->has('title') ? 'error' : '' }}"
                    placeholder="e.g. Frontend Developer" value="{{ old('title') }}" required>
                @error('title') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Company Name</label>
                <input type="text" name="company_name" class="form-control-custom" placeholder="Company name"
                    value="{{ old('company_name', auth()->user()->employerProfile->company_name) }}">
            </div>

            <div class="form-group">
                <label class="form-label-custom">Location</label>
                <input type="text" name="location" class="form-control-custom {{ $errors->has('location') ? 'error' : '' }}"
                    placeholder="e.g. Dublin" value="{{ old('location') }}" required>
                @error('location') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Salary <span
                        style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                <input type="text" name="salary" class="form-control-custom" placeholder="e.g. €50,000 - €65,000"
                    value="{{ old('salary') }}">
            </div>

            <div class="form-group">
                <label class="form-label-custom">Job Type</label>
                <select name="type" class="form-control-custom {{ $errors->has('type') ? 'error' : '' }}" required>
                    <option value="">-- Select type --</option>
                    <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('type') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Description</label>
                <textarea name="description" class="form-control-custom {{ $errors->has('description') ? 'error' : '' }}"
                    placeholder="Describe the role, requirements and benefits..." rows="5"
                    required>{{ old('description') }}</textarea>
                @error('description') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div style="display:flex; gap:10px; margin-top:8px;">
                <a href="{{ route('job-listings.index') }}" class="btn-secondary-custom"
                    style="flex:1; text-align:center; padding:12px;">Cancel</a>
                <button type="submit" class="btn-primary-custom" style="flex:1; padding:12px;">Post Job</button>
            </div>
        </form>
    </div>
@endsection
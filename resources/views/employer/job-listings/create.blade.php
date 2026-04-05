@extends('layouts.employer')
@section('title', 'Post a Job')

@section('content')
    <h5 class="fw-bold mb-3">Post a New Job</h5>

    <div class="card p-3">
        <form method="POST" action="{{ route('job-listings.store') }}">
            @csrf

            <div class="mb-3">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Title" value="{{ old('title') }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="company_name" class="form-control" placeholder="Company name"
                    value="{{ auth()->user()->employerProfile->company_name }}">
            </div>

            <div class="mb-3">
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                    placeholder="Location" value="{{ old('location') }}" required>
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="salary" class="form-control" placeholder="Salary (optional)"
                    value="{{ old('salary') }}">
            </div>

            <div class="mb-3">
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">-- Job Type --</option>
                    <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="Description" rows="4" required>{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('job-listings.index') }}" class="btn btn-outline-purple w-50">Cancel</a>
                <button type="submit" class="btn btn-purple w-50">Save</button>
            </div>
        </form>
    </div>
@endsection
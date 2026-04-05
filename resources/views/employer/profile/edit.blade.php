@extends('layouts.employer')
@section('title', 'Edit Profile')

@section('content')
    <h5 class="fw-bold mb-3">Company Profile</h5>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3">
        <form method="POST" action="{{ route('employer.profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                    placeholder="Company Name" value="{{ old('company_name', $profile->company_name) }}" required>
                @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                    placeholder="Location" value="{{ old('location', $profile->location) }}">
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
                    placeholder="Website (e.g. https://company.com)" value="{{ old('website', $profile->website) }}">
                @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    placeholder="Company Description" rows="4">{{ old('description', $profile->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-purple w-50">Cancel</a>
                <button type="submit" class="btn btn-purple w-50">Save</button>
            </div>
        </form>
    </div>
@endsection
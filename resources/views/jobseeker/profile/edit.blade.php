@extends('layouts.jobseeker')

@section('title', 'Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4">
                <h4 class="fw-bold mb-4">Jobseeker Profile</h4>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('jobseeker.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="display_name" class="form-label">{{ __('Display Name') }}</label>
                        <input
                            id="display_name"
                            name="display_name"
                            type="text"
                            value="{{ old('display_name', $profile?->display_name) }}"
                            required
                            class="form-control @error('display_name') is-invalid @enderror"
                        >
                        @error('display_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="display_email" class="form-label">{{ __('Display Email') }}</label>
                        <input
                            id="display_email"
                            name="display_email"
                            type="email"
                            value="{{ old('display_email', $profile?->display_email) }}"
                            required
                            class="form-control @error('display_email') is-invalid @enderror"
                        >
                        @error('display_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jobseeker.dashboard') }}" class="btn btn-outline-purple">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-purple">{{ __('Save Profile') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

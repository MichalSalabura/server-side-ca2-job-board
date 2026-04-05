<x-guest-layout>
    <style>
        :root {
            --purple: #6C63FF;
        }

        body {
            background-color: #f0f2f5;
        }

        .btn-purple {
            background-color: var(--purple);
            color: white;
            border-radius: 20px;
            border: none;
            width: 100%;
            padding: 10px;
        }

        .btn-purple:hover {
            background-color: #5a52d5;
            color: white;
        }

        input,
        select {
            border-radius: 8px !important;
        }

        .brand {
            color: var(--purple);
            font-weight: bold;
            font-size: 24px;
        }
    </style>

    <div class="text-center mb-4">
        <p class="brand">JobBoard</p>
        <p class="text-muted">Create your account</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Full Name" value="{{ old('name') }}" required autofocus>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Email" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                required>
        </div>

        <div class="mb-3">
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-- I am a... --</option>
                <option value="jobseeker" {{ old('role') == 'jobseeker' ? 'selected' : '' }}>Job Seeker</option>
                <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
            </select>
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-purple mb-3">Register</button>

        <p class="text-center text-muted" style="font-size:13px">
            Already registered?
            <a href="{{ route('login') }}" style="color: var(--purple)">Log in</a>
        </p>
    </form>
</x-guest-layout>
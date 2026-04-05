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

        input {
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
        <p class="text-muted">Welcome back</p>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label text-muted" for="remember" style="font-size:13px">Remember me</label>
        </div>

        <button type="submit" class="btn btn-purple mb-3">Log in</button>

        <p class="text-center text-muted" style="font-size:13px">
            Don't have an account?
            <a href="{{ route('register') }}" style="color: var(--purple)">Register</a>
        </p>

        @if(Route::has('password.request'))
            <p class="text-center" style="font-size:13px">
                <a href="{{ route('password.request') }}" style="color: var(--purple)">Forgot password?</a>
            </p>
        @endif
    </form>
</x-guest-layout>
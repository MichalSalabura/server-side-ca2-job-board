<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Company Profile</title>
</head>
<body>
    <h1>Edit Company Profile</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('employer.profile.update') }}">
        @csrf
        @method('PATCH')

        <div>
            <label>Company Name</label>
            <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name) }}" required>
            @error('company_name') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description', $profile->description) }}</textarea>
            @error('description') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $profile->location) }}">
            @error('location') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Website</label>
            <input type="url" name="website" value="{{ old('website', $profile->website) }}">
            @error('website') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="{{ route('employer.dashboard') }}">← Back to Dashboard</a>
</body>
</html>
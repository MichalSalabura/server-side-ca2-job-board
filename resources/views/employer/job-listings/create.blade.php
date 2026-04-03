<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job</title>
</head>
<body>
    <h1>Post a New Job</h1>

    <form method="POST" action="{{ route('job-listings.store') }}">
        @csrf

        <div>
            <label>Job Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" required>{{ old('description') }}</textarea>
            @error('description') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location') }}" required>
            @error('location') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Salary (optional)</label>
            <input type="text" name="salary" value="{{ old('salary') }}">
        </div>

        <div>
            <label>Job Type</label>
            <select name="type" required>
                <option value="">-- Select --</option>
                <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
            </select>
            @error('type') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Post Job</button>
    </form>

    <br>
    <a href="{{ route('job-listings.index') }}">← Back to Listings</a>
</body>
</html>
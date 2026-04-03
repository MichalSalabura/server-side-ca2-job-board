<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Job</title>
</head>
<body>
    <h1>Edit Job Listing</h1>

    <form method="POST" action="{{ route('job-listings.update', $jobListing) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Job Title</label>
            <input type="text" name="title" value="{{ old('title', $jobListing->title) }}" required>
            @error('title') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" required>{{ old('description', $jobListing->description) }}</textarea>
            @error('description') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $jobListing->location) }}" required>
            @error('location') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Salary (optional)</label>
            <input type="text" name="salary" value="{{ old('salary', $jobListing->salary) }}">
        </div>

        <div>
            <label>Job Type</label>
            <select name="type" required>
                <option value="full-time" {{ old('type', $jobListing->type) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="part-time" {{ old('type', $jobListing->type) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="contract" {{ old('type', $jobListing->type) == 'contract' ? 'selected' : '' }}>Contract</option>
                <option value="internship" {{ old('type', $jobListing->type) == 'internship' ? 'selected' : '' }}>Internship</option>
            </select>
            @error('type') <span style="color:red">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="open" {{ old('status', $jobListing->status) == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ old('status', $jobListing->status) == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <button type="submit">Update Job</button>
    </form>

    <br>
    <a href="{{ route('job-listings.index') }}">← Back to Listings</a>
</body>
</html>
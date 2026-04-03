<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $jobListing->title }}</title>
</head>
<body>
    <h1>{{ $jobListing->title }}</h1>
    <p><strong>Location:</strong> {{ $jobListing->location }}</p>
    <p><strong>Type:</strong> {{ $jobListing->type }}</p>
    <p><strong>Salary:</strong> {{ $jobListing->salary ?? 'Not specified' }}</p>
    <p><strong>Status:</strong> {{ $jobListing->status }}</p>
    <p><strong>Description:</strong> {{ $jobListing->description }}</p>

    <a href="{{ route('job-listings.edit', $jobListing) }}">Edit</a> |
    <form method="POST" action="{{ route('job-listings.destroy', $jobListing) }}" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this job?')">Delete</button>
    </form>

    <br>
    <a href="{{ route('job-listings.index') }}">← Back to Listings</a>
</body>
</html>
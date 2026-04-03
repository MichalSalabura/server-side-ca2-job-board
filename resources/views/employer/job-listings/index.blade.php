    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Job Listings</title>
</head>
<body>
    <h1>My Job Listings</h1>
    <a href="{{ route('job-listings.create') }}">+ Post New Job</a>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if($jobs->isEmpty())
        <p>No job listings yet.</p>
    @else
        <table border="1" cellpadding="8">
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->location }}</td>
                <td>{{ $job->type }}</td>
                <td>{{ $job->status }}</td>
                <td>
                    <a href="{{ route('job-listings.show', $job) }}">View</a> |
                    <a href="{{ route('job-listings.edit', $job) }}">Edit</a> |
                    <form method="POST" action="{{ route('job-listings.destroy', $job) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this job?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @endif

    <br>
    <a href="{{ route('employer.dashboard') }}">← Back to Dashboard</a>
</body>
</html>
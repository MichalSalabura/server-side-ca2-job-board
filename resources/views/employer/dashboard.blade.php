<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employer Dashboard</title>
</head>

<body>
    <h1>Employer Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>Company: {{ auth()->user()->employerProfile->company_name ?? 'Not set' }}</p>

    <hr>

    <h2>Overview</h2>
    <p>Total Job Listings: <strong>{{ $jobCount }}</strong></p>

    <h2>Recent Listings</h2>
    @if ($recentJobs->isEmpty())
        <p>No job listings yet.</p>
    @else
        <ul>
            @foreach ($recentJobs as $job)
                <li>
                    <a href="{{ route('job-listings.show', $job) }}">{{ $job->title }}</a>
                    — {{ $job->location }} ({{ $job->type }}) — {{ $job->status }}
                </li>
            @endforeach
        </ul>
    @endif

    <hr>

    <nav>
        <a href="{{ route('job-listings.index') }}">My Job Listings</a> |
        <a href="{{ route('job-listings.create') }}">Post New Job</a> |
        <a href="{{ route('employer.profile.edit') }}">Edit Company Profile</a> |
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
</body>

</html>

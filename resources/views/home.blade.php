<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobBoard - Find Your Next Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --purple: #6C63FF;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-custom {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
        }

        .btn-purple {
            background-color: var(--purple);
            color: white;
            border: none;
            border-radius: 20px;
        }

        .btn-purple:hover {
            background-color: #5a52d5;
            color: white;
        }

        .btn-outline-purple {
            border: 2px solid var(--purple);
            color: var(--purple);
            border-radius: 20px;
            background: white;
        }

        .btn-outline-purple:hover {
            background-color: var(--purple);
            color: white;
        }

        .job-card {
            border-radius: 12px;
            background: white;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 16px;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .job-card:hover {
            box-shadow: 0 4px 16px rgba(108, 99, 255, 0.15);
            color: inherit;
        }

        input,
        select {
            border-radius: 8px !important;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-custom px-3 py-2 d-flex justify-content-between align-items-center">
        <span class="fw-bold" style="color: var(--purple)">JobBoard</span>
        <div class="d-flex gap-2">
            @auth
                @if(auth()->user()->role === 'employer')
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-sm btn-purple">Dashboard</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-purple">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-purple">Login</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-purple">Register</a>
            @endauth
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container py-3">

        {{-- Search --}}
        <div class="input-group mb-3">
            <span class="input-group-text bg-white">🔍</span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search jobs...">
        </div>

        {{-- Filter --}}
        <div class="mb-3">
            <select id="filterType" class="form-select">
                <option value="">All Types</option>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
            </select>
        </div>

        {{-- Job Listings --}}
        <div id="jobList">
            @forelse($jobs as $job)
                <div class="job-card" data-title="{{ strtolower($job->title) }}" data-type="{{ $job->type }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="fw-bold mb-1" style="font-size:15px">{{ $job->title }}</p>
                            <p class="text-muted mb-1" style="font-size:12px">{{ $job->company_name }}</p>
                            <p class="text-muted mb-1" style="font-size:12px">{{ $job->location }}</p>
                        </div>
                        <span class="badge" style="background-color: var(--purple); font-size:10px">{{ $job->type }}</span>
                    </div>
                    <p style="font-size:12px" class="mt-2 mb-2">{{ Str::limit($job->description, 80) }}</p>
                    @auth
                        <a href="#" class="btn btn-sm btn-purple">Apply Now</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-purple">Login to Apply</a>
                    @endauth
                </div>
            @empty
                <p class="text-muted text-center">No job listings available yet.</p>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Client-side search and filter
        const searchInput = document.getElementById('searchInput');
        const filterType = document.getElementById('filterType');
        const cards = document.querySelectorAll('.job-card');

        function filterJobs() {
            const search = searchInput.value.toLowerCase();
            const type = filterType.value;

            cards.forEach(card => {
                const titleMatch = card.dataset.title.includes(search);
                const typeMatch = type === '' || card.dataset.type === type;
                card.style.display = titleMatch && typeMatch ? 'block' : 'none';
            });
        }

        searchInput.addEventListener('input', filterJobs);
        filterType.addEventListener('change', filterJobs);
    </script>
</body>

</html>
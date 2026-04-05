<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobBoard - @yield('title')</title>
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

        .navbar-custom .nav-link {
            color: #333;
            font-weight: 500;
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

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .job-card {
            border-radius: 12px;
            background: white;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 16px;
        }

        .offcanvas-header {
            background-color: var(--purple);
            color: white;
        }

        .sidebar-btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            border-radius: 20px;
            padding: 10px;
            background-color: var(--purple);
            color: white;
            border: none;
            text-align: center;
            text-decoration: none;
        }

        .sidebar-btn:hover {
            background-color: #5a52d5;
            color: white;
        }

        .sidebar-btn.outline {
            background-color: white;
            color: var(--purple);
            border: 2px solid var(--purple);
        }

        input,
        textarea,
        select {
            border-radius: 8px !important;
        }
    </style>
</head>

<body>

    {{-- Top Navbar --}}
    <nav class="navbar navbar-custom px-3 py-2 d-flex justify-content-between align-items-center">
        <button class="btn btn-sm btn-purple" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            Menu
        </button>
        <span class="fw-bold" style="color: var(--purple)">JobBoard</span>
        <div class="d-flex align-items-center gap-2">
            @if(isset($newApplications) && $newApplications > 0)
                <span class="badge rounded-pill" style="background-color: var(--purple)">
                    {{ $newApplications }} new
                </span>
            @endif
            <a href="{{ route('employer.profile.edit') }}" class="btn btn-sm btn-outline-purple">Profile</a>
        </div>
    </nav>

    {{-- Sidebar --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <a href="{{ route('job-listings.index') }}" class="sidebar-btn">My Postings</a>
            <a href="{{ route('job-listings.create') }}" class="sidebar-btn">Post an Offer</a>
            <a href="{{ route('employer.dashboard') }}" class="sidebar-btn outline">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="sidebar-btn" style="background-color: #ff4d4d;">Log out</button>
            </form>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container py-3">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHire - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/employer.css', 'resources/js/app.js'])
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar-custom">
        <button class="btn-ghost" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
            style="padding: 8px 12px;">
            ☰ Menu
        </button>
        <a href="/" class="brand">TechHire</a>
        <div class="nav-actions">
            @if(isset($newApplications) && $newApplications > 0)
                <span class="notif-badge">{{ $newApplications }} new</span>
            @endif
            <a href="{{ route('employer.profile.edit') }}" class="btn-secondary-custom" style="padding: 7px 14px;">
                Profile
            </a>
        </div>
    </nav>

    {{-- Sidebar --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" style="max-width: 280px;">
        <div class="offcanvas-header">
            <div>
                <h5 class="offcanvas-title">TechHire</h5>
                <p style="font-size:12px; opacity:0.8; margin:0">{{ auth()->user()->name }}</p>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body" style="padding: 16px;">
            <a href="{{ url('/') }}" class="sidebar-item">
                🏠 Homepage
            </a>
            <a href="{{ route('employer.dashboard') }}" class="sidebar-item">
                📊 Dashboard
            </a>
            <a href="{{ route('job-listings.index') }}" class="sidebar-item">
                📋 My Postings
            </a>
            <a href="{{ route('job-listings.create') }}" class="sidebar-item">
                ➕ Post a Job
            </a>
            <a href="{{ route('employer.profile.edit') }}" class="sidebar-item">
                🏢 Company Profile
            </a>
            <hr class="sidebar-divider">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    🚪 Log out
                </button>
            </form>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="main-container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
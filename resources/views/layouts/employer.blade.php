<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHire - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --purple: #6C63FF;
            --purple-light: #efe9ff;
            --purple-dark: #5a52d5;
            --bg: #f7f8fc;
            --card-bg: #ffffff;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text);
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar-custom {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border);
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand {
            color: var(--purple);
            font-weight: 700;
            font-size: 20px;
            text-decoration: none;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Buttons */
        .btn-primary-custom {
            background-color: var(--purple);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 9px 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-primary-custom:hover {
            background-color: var(--purple-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-secondary-custom {
            background-color: var(--purple-light);
            color: var(--purple);
            border: none;
            border-radius: 10px;
            padding: 9px 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-secondary-custom:hover {
            background-color: #e0d7ff;
            color: var(--purple);
        }

        .btn-danger-custom {
            background-color: #fef2f2;
            color: var(--danger);
            border: none;
            border-radius: 10px;
            padding: 9px 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-danger-custom:hover {
            background-color: #fee2e2;
            color: var(--danger);
        }

        .btn-ghost {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            padding: 9px 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-ghost:hover {
            background-color: var(--bg);
            color: var(--text);
        }

        /* Cards */
        .card-custom {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            margin-bottom: 12px;
        }

        .card-custom:hover {
            box-shadow: 0 4px 16px rgba(108, 99, 255, 0.1);
            border-color: #d4ceff;
        }

        /* Stat cards */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            border: 1px solid var(--border);
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--purple);
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 4px;
        }

        /* Badges */
        .badge-type {
            background-color: var(--purple-light);
            color: var(--purple);
            border-radius: 6px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-open {
            background-color: #d1fae5;
            color: var(--success);
            border-radius: 6px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-closed {
            background-color: #f3f4f6;
            color: var(--text-muted);
            border-radius: 6px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        /* Forms */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            background: white;
            transition: border-color 0.2s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(108, 99, 255, 0.1);
        }

        .form-control-custom.error {
            border-color: var(--danger);
        }

        .error-msg {
            color: var(--danger);
            font-size: 11px;
            margin-top: 4px;
        }

        /* Alert */
        .alert-success-custom {
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .alert-info-custom {
            background-color: var(--purple-light);
            color: var(--purple);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        /* Page header */
        .page-header {
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            margin: 0;
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Sidebar */
        .offcanvas-header {
            background-color: var(--purple);
            color: white;
            padding: 20px;
        }

        .offcanvas-title {
            font-weight: 700;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
            transition: background 0.2s;
        }

        .sidebar-item:hover {
            background-color: var(--bg);
            color: var(--purple);
        }

        .sidebar-item.active {
            background-color: var(--purple-light);
            color: var(--purple);
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 12px 0;
        }

        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            color: var(--danger);
            font-size: 14px;
            font-weight: 500;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s;
        }

        .sidebar-logout:hover {
            background-color: #fef2f2;
        }

        /* Notification badge */
        .notif-badge {
            background-color: var(--danger);
            color: white;
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 700;
        }

        /* Main container */
        .main-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 16px;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 16px 0;
        }
    </style>
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
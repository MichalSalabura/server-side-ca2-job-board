<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHire - Find Your Next Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        :root {
            --purple: #6C63FF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar-custom {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 12px 16px;
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

        .btn-purple {
            background-color: var(--purple);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 7px 16px;
            text-decoration: none;
            font-size: 13px;
            display: inline-block;
        }

        .btn-purple:hover {
            background-color: #5a52d5;
            color: white;
        }

        .btn-outline-purple {
            border: 2px solid var(--purple);
            color: var(--purple);
            border-radius: 20px;
            padding: 5px 14px;
            text-decoration: none;
            font-size: 13px;
            background: white;
            display: inline-block;
        }

        .btn-outline-purple:hover {
            background-color: var(--purple);
            color: white;
        }

        /* Map */
        #map {
            width: 100%;
            height: 280px;
        }

        /* Search */
        .search-section {
            padding: 12px 16px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .search-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .search-row input {
            flex: 1;
            border: 1px solid #e0e0e0;
            border-radius: 20px !important;
            padding: 8px 14px;
            font-size: 13px;
        }

        .search-row input:focus {
            outline: none;
            border-color: var(--purple);
        }

        .filter-row {
            display: flex;
            gap: 8px;
        }

        .filter-row select {
            flex: 1;
            border: 1px solid #e0e0e0;
            border-radius: 20px !important;
            padding: 7px 12px;
            font-size: 12px;
            background: white;
            appearance: none;
        }

        .filter-row select:focus {
            outline: none;
            border-color: var(--purple);
        }

        /* Results */
        .results-header {
            padding: 10px 16px;
            font-size: 12px;
            color: #888;
            background: #f0f2f5;
        }

        /* Job list */
        .job-list {
            padding: 0 16px 80px;
        }

        /* Job card */
        .job-card {
            background: white;
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s;
        }

        .job-card:hover,
        .job-card.active {
            border-color: var(--purple);
        }

        .job-title {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 2px;
            color: #1a1a2e;
        }

        .job-company {
            color: #555;
            font-size: 12px;
            margin-bottom: 3px;
        }

        .job-location {
            color: #888;
            font-size: 12px;
        }

        .job-meta {
            display: flex;
            gap: 6px;
            margin-top: 8px;
            flex-wrap: wrap;
            align-items: center;
        }

        .badge-type {
            background-color: #efe9ff;
            color: var(--purple);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-salary {
            background-color: #e9f7ef;
            color: #27ae60;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .apply-btn {
            margin-left: auto;
            background-color: var(--purple);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 11px;
            text-decoration: none;
            display: inline-block;
        }

        .apply-btn:hover {
            background-color: #5a52d5;
            color: white;
        }

        /* Desktop layout */
        @media (min-width: 768px) {
            .main-layout {
                display: flex;
                height: calc(100vh - 57px);
            }

            .left-panel {
                width: 420px;
                min-width: 320px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                border-right: 1px solid #e0e0e0;
            }

            .job-list-wrapper {
                flex: 1;
                overflow-y: auto;
            }

            #map {
                flex: 1;
                height: 100%;
            }

            .mobile-map {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .desktop-map {
                display: none;
            }

            .main-layout {
                display: block;
            }

            .left-panel {
                width: 100%;
            }

            .job-list-wrapper {
                overflow: visible;
            }
        }

        .btn-ghost {
            background: none;
            border: none;
            color: #333;
            font-size: 18px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .btn-ghost:hover {
            background-color: #f0f2f5;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar-custom">
        <div style="display:flex; align-items:center; gap:10px;">
            @auth
                @if(auth()->user()->role === 'employer')
                    <button class="btn-ghost" type="button" data-bs-toggle="offcanvas" data-bs-target="#homeSidebar"
                        style="padding: 8px 12px;">
                        ☰
                    </button>
                @endif
            @endauth
            <a href="/" class="brand">TechHire</a>
        </div>
        <div style="display:flex; gap:8px; align-items:center;">
            @auth
                @if(auth()->user()->role === 'employer')
                    <a href="{{ route('employer.dashboard') }}" class="btn-purple">Dashboard</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-purple">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-outline-purple">Login</a>
                <a href="{{ route('register') }}" class="btn-purple">Register</a>
            @endauth
        </div>
    </nav>

    @auth
        @if(auth()->user()->role === 'employer')
            <div class="offcanvas offcanvas-start" tabindex="-1" id="homeSidebar" style="max-width: 280px;">
                <div class="offcanvas-header" style="background-color: #6C63FF; color: white; padding: 20px;">
                    <div>
                        <h5 style="margin:0; font-weight:700;">TechHire</h5>
                        <p style="font-size:12px; opacity:0.8; margin:0;">{{ auth()->user()->name }}</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body" style="padding: 16px;">
                    <a href="{{ url('/') }}"
                        style="display:flex; align-items:center; gap:10px; padding:12px 16px; border-radius:10px; text-decoration:none; color:#1a1a2e; font-size:14px; font-weight:500; margin-bottom:4px;">
                        🏠 Homepage
                    </a>
                    <a href="{{ route('employer.dashboard') }}"
                        style="display:flex; align-items:center; gap:10px; padding:12px 16px; border-radius:10px; text-decoration:none; color:#1a1a2e; font-size:14px; font-weight:500; margin-bottom:4px;">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('job-listings.index') }}"
                        style="display:flex; align-items:center; gap:10px; padding:12px 16px; border-radius:10px; text-decoration:none; color:#1a1a2e; font-size:14px; font-weight:500; margin-bottom:4px;">
                        📋 My Postings
                    </a>
                    <a href="{{ route('job-listings.create') }}"
                        style="display:flex; align-items:center; gap:10px; padding:12px 16px; border-radius:10px; text-decoration:none; color:#1a1a2e; font-size:14px; font-weight:500; margin-bottom:4px;">
                        ➕ Post a Job
                    </a>
                    <a href="{{ route('employer.profile.edit') }}"
                        style="display:flex; align-items:center; gap:10px; padding:12px 16px; border-radius:10px; text-decoration:none; color:#1a1a2e; font-size:14px; font-weight:500; margin-bottom:4px;">
                        🏢 Company Profile
                    </a>
                    <hr style="border:none; border-top:1px solid #e5e7eb; margin:12px 0;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="display:flex; align-items:center; gap:10px; padding:12px 16px;
                            border-radius:10px; color:#ef4444; font-size:14px; font-weight:500; background:none; border:none;
                            width:100%; cursor:pointer;">
                            🚪 Log out
                            </button> </form>
                </div>
            </div>
        @endif
    @endauth


    {{-- Mobile map (shows above job list on mobile) --}}
    <div class="mobile-map">
        <div id="map-mobile" style="width:100%; height:250px;"></div>
    </div>

    {{-- Main Layout --}}
    <div class="main-layout">

        {{-- Left Panel (search + job list) --}}
        <div class="left-panel">

            {{-- Search & Filter --}}
            <div class="search-section">
                <div class="search-row">
                    <input type=" text" id="searchInput" placeholder="🔍 Search jobs or companies...">
                </div>
                <div class="filter-row">
                    <select id="filterType">
                        <option value="">All Types</option>
                        <option value="full-time">Full-time</option>
                        <option value="part-time">Part-time</option>
                        <option value="contract">Contract</option>
                        <option value="internship">Internship</option>
                        </select>
                        <select id="filterLocation">
                            <option value="">All Locations</option>
                            @foreach($jobs->pluck('location')->unique() as $loc)
                                <option value="{{ strtolower($loc) }}">{{ $loc }}</option>
                            @endforeach
                        </select>
                </div>
            </div>

            <div class="results-header" id="resultsCount">{{ $jobs->count() }} jobs found</div>

            {{-- Job Cards --}}
            <div class="job-list-wrapper">
                <div class="job-list" id="jobList">
                    @foreach($jobs as $job)
                        <div class="job-card" data-title="{{ strtolower($job->title) }}"
                            data-company="{{ strtolower($job->company_name) }}" data-type="{{ $job->type }}"
                            data-location="{{ strtolower($job->location) }}" data-lat="{{ $job->latitude }}"
                            data-lng="{{ $job->longitude }}" data-id="{{ $job->id }}"
                            onclick="focusJob({{ $job->id }}, {{ $job->latitude ?? 'null' }}, {{ $job->longitude ?? 'null' }})">
                            <div class="job-title">{{ $job->title }}</div>
                            <div class="job-company">{{ $job->company_name }}</div>
                            <div class="job-location">📍 {{ $job->location }}</div>
                            <div class="job-meta">
                                <span class="badge-type">{{ $job->type }}</span>
                                @if($job->salary)
                                    <span class="badge-salary">{{ $job->salary }}</span>
                                @endif
                                @auth
                                    <a href="#" class="apply-btn">Apply</a>
                                @else
                                    <a href="{{ route('login') }}" class="apply-btn">Apply</a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Desktop Map --}}
        <div class="desktop-map" id="map" style="flex:1;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const isMobile = window.innerWidth < 768;

        // Show correct map container
        if (isMobile) {
            document.querySelector('.mobile-map').style.display = 'block';
        }

        const mapEl = isMobile ? 'map-mobile' : 'map';

        const map = L.map(mapEl).setView([53.1424, -7.6921], 7);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const purpleIcon = L.divIcon({
            className: '',
            html: `<div style="background:#6C63FF;width:14px;height:14px;border-radius:50%;border:2px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3)"></div>`,
            iconSize: [14, 14],
            iconAnchor: [7, 7],
        });

        const markers = {};
        const cards = document.querySelectorAll('.job-card');

        cards.forEach(card => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const id = card.dataset.id;

            if (!isNaN(lat) && !isNaN(lng)) {
                const marker = L.marker([lat, lng], { icon: purpleIcon })
                    .addTo(map)
                    .bindPopup(`
                    <strong>${card.querySelector('.job-title').innerText}</strong><br>
                    ${card.querySelector('.job-company').innerText}<br>
                    ${card.querySelector('.job-location').innerText}
                `);
                markers[id] = marker;

                marker.on('click', () => {
                    cards.forEach(c => c.classList.remove('active'));
                    const matchCard = document.querySelector(`[data-id="${id}"]`);
                    if (matchCard) {
                        matchCard.classList.add('active');
                        matchCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                });
            }
        });

        function focusJob(id, lat, lng) {
            cards.forEach(c => c.classList.remove('active'));
            document.querySelector(`[data-id="${id}"]`).classList.add('active');
            if (lat && lng) {
                map.setView([lat, lng], 12);
                if (markers[id]) markers[id].openPopup();
            }
        }

        const searchInput = document.getElementById('searchInput');
        const filterType = document.getElementById('filterType');
        const filterLocation = document.getElementById('filterLocation');
        const resultsCount = document.getElementById('resultsCount');

        function filterJobs() {
            const search = searchInput.value.toLowerCase();
            const type = filterType.value;
            const location = filterLocation.value;
            let count = 0;

            cards.forEach(card => {
                const titleMatch = card.dataset.title.includes(search) || card.dataset.company.includes(search);
                const typeMatch = type === '' || card.dataset.type === type;
                const locationMatch = location === '' || card.dataset.location === location;
                const visible = titleMatch && typeMatch && locationMatch;
                card.style.display = visible ? 'block' : 'none';
                if (visible) count++;
            });

            resultsCount.textContent = `${count} jobs found`;
        }

        searchInput.addEventListener('input', filterJobs);
        filterType.addEventListener('change', filterJobs);
        filterLocation.addEventListener('change', filterJobs);
    </script>
</body>

</html>
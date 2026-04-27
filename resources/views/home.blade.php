<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechHire - Find Your Next Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @vite(['resources/css/home.css', 'resources/js/app.js'])
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
                        <button type="submit"
                            style="display:flex; align-items:center; gap:10px; padding:12px 16px;
                                                                                                                                            border-radius:10px; color:#ef4444; font-size:14px; font-weight:500; background:none; border:none;
                                                                                                                                            width:100%; cursor:pointer;">
                            🚪 Log out
                        </button>
                    </form>
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
                <div class="search-row" style="position:relative;">
                    <input type="text" id="searchInput" placeholder="🔍  Search jobs or companies...">
                    <button id="clearSearch" onclick="clearSearch()"
                        style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#888; font-size:16px; cursor:pointer; display:none;">
                        ✕
                    </button>
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
                <div class="filter-row" style="margin-top: 8px;">
                    <select id="filterSalary">
                        <option value="">All Salaries</option>
                        <option value="30000">€30,000+</option>
                        <option value="40000">€40,000+</option>
                        <option value="50000">€50,000+</option>
                        <option value="60000">€60,000+</option>
                        <option value="70000">€70,000+</option>
                        <option value="90000">€90,000+</option>
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
                            data-salary="{{ preg_replace('/[^0-9]/', '', explode('-', $job->salary ?? '0')[0]) }}"
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
                                    @if(auth()->user()->role === 'jobseeker')
                                        <a href="#" class="apply-btn">Apply</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="apply-btn">Login to Apply</a>
                                @endauth
                            </div>
                            <div style="display:flex; gap:6px; margin-top:8px;">
                                <a href="https://wa.me/?text={{ urlencode($job->title . ' at ' . $job->company_name . ' - ' . url('/')) }}"
                                    target="_blank"
                                    style="background:#25D366; color:white; border-radius:20px; padding:3px 10px; font-size:11px; text-decoration:none; font-weight:600;">
                                    WhatsApp
                                </a>
                                <a href="mailto:?subject={{ urlencode($job->title . ' at ' . $job->company_name) }}&body={{ urlencode('Check out this job: ' . url('/')) }}"
                                    style="background:#6C63FF; color:white; border-radius:20px; padding:3px 10px; font-size:11px; text-decoration:none; font-weight:600;">
                                    Email
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url('/')) }}"
                                    target="_blank"
                                    style="background:#0077B5; color:white; border-radius:20px; padding:3px 10px; font-size:11px; text-decoration:none; font-weight:600;">
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Desktop Map --}}
        <div class="desktop-map" style="flex:1; display:flex; flex-direction:column;">
            <div id="map" style="flex:1;"></div>
            <div id="jobDetail"
                style="height:260px; background:white; border-top:1px solid #e0e0e0; padding:20px; overflow-y:auto; display:none;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:8px;">
                    <div>
                        <h3 id="detailTitle" style="font-size:16px; font-weight:700; margin:0 0 3px;"></h3>
                        <p id="detailCompany" style="color:#555; font-size:13px; margin:0 0 3px;"></p>
                        <p id="detailLocation" style="color:#888; font-size:12px; margin:0;"></p>
                    </div>
                    <div id="detailBadges" style="display:flex; gap:6px; flex-wrap:wrap;"></div>
                </div>
                <hr style="border:none; border-top:1px solid #e5e7eb; margin:12px 0;">
                <p id="detailSalary" style="font-size:13px; color:#16a34a; font-weight:600; margin:0 0 8px;"></p>
                <p id="detailDescription" style="font-size:13px; line-height:1.6; color:#333; margin:0;"></p>
            </div>
        </div>
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
            const card = document.querySelector(`[data-id="${id}"]`);
            card.classList.add('active');

            if (lat && lng) {
                map.setView([lat, lng], 12);
                if (markers[id]) markers[id].openPopup();
            }

            if (!isMobile) {
                const detail = document.getElementById('jobDetail');
                detail.style.display = 'block';
                document.getElementById('detailTitle').innerText = card.querySelector('.job-title').innerText;
                document.getElementById('detailCompany').innerText = card.querySelector('.job-company').innerText;
                document.getElementById('detailLocation').innerText = card.querySelector('.job-location').innerText;

                const salary = card.dataset.salary;
                const salaryEl = document.getElementById('detailSalary');
                salaryEl.innerText = salary && salary !== '0' ? '€' + parseInt(salary).toLocaleString() + '+' : '';

                const badges = document.getElementById('detailBadges');
                badges.innerHTML = `<span style="background:#efe9ff; color:#6C63FF; border-radius:6px; padding:3px 10px; font-size:11px; font-weight:600;">${card.dataset.type}</span>`;
            }
        }

        const searchInput = document.getElementById('searchInput');
        const filterType = document.getElementById('filterType');
        const filterLocation = document.getElementById('filterLocation');
        const resultsCount = document.getElementById('resultsCount');
        const filterSalary = document.getElementById('filterSalary');

        function filterJobs() {
            const search = searchInput.value.toLowerCase();
            const type = filterType.value;
            const location = filterLocation.value;
            const salary = filterSalary.value;
            let count = 0;

            cards.forEach(card => {
                const titleMatch = card.dataset.title.includes(search) || card.dataset.company.includes(search);
                const typeMatch = type === '' || card.dataset.type === type;
                const locationMatch = location === '' || card.dataset.location === location;
                const salaryMatch = salary === '' || parseInt(card.dataset.salary) >= parseInt(salary);
                const visible = titleMatch && typeMatch && locationMatch && salaryMatch;
                card.style.display = visible ? 'block' : 'none';
                if (visible) count++;
            });

            resultsCount.textContent = `${count} jobs found`;
        }


        function clearSearch() {
            searchInput.value = '';
            document.getElementById('clearSearch').style.display = 'none';
            filterJobs();
        }

        searchInput.addEventListener('input', () => {
            document.getElementById('clearSearch').style.display =
                searchInput.value ? 'block' : 'none';
            filterJobs();
        });

        filterType.addEventListener('change', filterJobs);
        filterLocation.addEventListener('change', filterJobs);
        filterSalary.addEventListener('change', filterJobs);
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard</title>
</head>

<body>
    <h1>Employer Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>Company: {{ auth()->user()->employerProfile->company_name ?? 'Not set' }}</p>

    <nav>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
</body>

</html>

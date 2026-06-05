<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Voters Report</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
</head>
<body class="export-pdf">
    <h2 class="report-title">Voters Report</h2>
    <p class="report-subtitle">PSU-Lingayen Campus SSC Elections 2026</p>

    <table class="report-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>College</th>
                <th>Program</th>
                <th>Year & Section</th>
                <th>Status</th>
                <th>Voted At</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($voters as $voter)
                <tr>
                    <td>{{ $voter->student_id }}</td>
                    <td>{{ $voter->last_name }}, {{ $voter->first_name }}</td>
                    <td>{{ $voter->college }}</td>
                    <td>{{ $voter->program }}</td>
                    <td>{{ $voter->year_and_section }}</td>
                    <td>{{ $voter->has_voted ? 'Voted' : 'Not Yet' }}</td>
                    <td>{{ $voter->voted_at ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
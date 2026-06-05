<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Candidates Report</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
</head>
<body class="export-pdf">
    <h2 class="report-title">Candidates Report</h2>
    <p class="report-subtitle">PSU-Lingayen Campus SSC Elections 2026</p>

    <table class="report-table">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>College</th>
                <th>Partylist</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->position->name ?? 'No Position' }}</td>
                    <td>{{ $candidate->full_name }}</td>
                    <td>{{ $candidate->college }}</td>
                    <td>{{ $candidate->partylist ?? '—' }}</td>
                    <td>{{ $candidate->is_active ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
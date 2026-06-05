<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Results Report</title>
    <link rel="stylesheet" href="{{ public_path('css/style.css') }}">
</head>
<body class="export-pdf">
    <h2>Election Results Report</h2>
    <p>PSU-Lingayen Campus SSC Elections 2026</p>

    <table class="report-table">
        <thead>
            <tr>
                <th>Position</th>
                <th>Candidate Name</th>
                <th>College</th>
                <th>Partylist</th>
                <th>Votes</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($results as $candidate)
                <tr>
                    <td>{{ $candidate->position->name ?? 'No Position' }}</td>
                    <td>{{ $candidate->full_name }}</td>
                    <td>{{ $candidate->college }}</td>
                    <td>{{ $candidate->partylist ?? '—' }}</td>
                    <td>{{ $candidate->total_votes ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
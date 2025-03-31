<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accreditation Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Accreditation Report</h2>
        <p>Generated on: {{ now()->format('F j, Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Accreditation No</th>
                <th>Cooperative Name</th>
                <th>Region</th>
                <th>City</th>
                {{-- <th>Status</th> --}}
                <th>Accreditation Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cooperatives as $coop)
                <tr>
                    <td>{{ $coop->accreditation_no }}</td>
                    <td>{{ $coop->name }}</td>
                    <td>{{ $coop->region }}</td>
                    <td>{{ $coop->city }}</td>
                    {{-- <td>{{ $coop->status }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($coop->accreditation_date)->format('M j, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGS Renewal Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div>
        <h2 style="text-align: center;">CGS Renewal Report</h2>
        <p>Generated on: {{ now()->format('F j, Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>CDA Registration No</th>
                <th>Accreditation No</th>
                <th>Cooperative Name</th>
                <th>Validity Date</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cooperatives as $coop)
                <tr>
                    <td>{{ $coop->cda_registration_no }}</td>
                    <td>{{ $coop->accreditation_no }}</td>
                    <td>{{ $coop->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($coop->validity_date)->format('F d, Y') }}</td>
                    <td>{{ $coop->region }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

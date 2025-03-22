<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $report_type }} Report - {{ $year ?? 'All Years' }}</title>
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

        .meta {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>

    @php
        $regions = [
            '010000000' => 'Region I (Ilocos Region)',
            '020000000' => 'Region II (Cagayan Valley)',
            '030000000' => 'Region III (Central Luzon)',
            '040000000' => 'Region IV-A (CALABARZON)',
            '170000000' => 'MIMAROPA Region',
            '050000000' => 'Region V (Bicol Region)',
            '060000000' => 'Region VI (Western Visayas)',
            '070000000' => 'Region VII (Central Visayas)',
            '080000000' => 'Region VIII (Eastern Visayas)',
            '090000000' => 'Region IX (Zamboanga Peninsula)',
            '100000000' => 'Region X (Northern Mindanao)',
            '110000000' => 'Region XI (Davao Region)',
            '120000000' => 'Region XII (SOCCSKSARGEN)',
            '130000000' => 'Region XIII (Caraga)',
            'CAR' => 'Cordillera Administrative Region',
            'NCR' => 'National Capital Region',
            'BARMM' => 'Bangsamoro Autonomous Region in Muslim Mindanao',
        ];
    @endphp


    <div class="header">
        <h2>{{ $report_type }} Report</h2>
        <p>Region: {{ $region ?? 'All Regions' }}</p>
        <p>Year: {{ $year ?? 'All Years' }}</p>
        <p>Date Generated: {{ \Carbon\Carbon::parse($generated_at)->format('F d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cooperative Name</th>
                <th>Registration No.</th>
                <th>Region</th>
                <th>Status</th>
                <th>Validity Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($generalInfos as $index => $info)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $info->name ?? 'N/A' }}</td>
                    <td>{{ $info->cda_registration_no ?? 'N/A' }}</td>
                    <td>
                        {{ $regions[$info->region] ?? 'N/A' }}
                    </td>
                    
                    <td>{{ ucfirst($info->status) ?? 'N/A' }}</td>
                    <td>{{ $info->validity_date ? \Carbon\Carbon::parse($info->validity_date)->format('M d, Y') : 'N/A' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>

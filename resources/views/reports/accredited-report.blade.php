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

        .logo-container {
            text-align: center;
            margin-bottom: 0px;
        }

        .logo {
            max-width: 80%;
            height: auto;
            opacity: .9;
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

    @php
        $path = public_path('images/OTC-UpdatedBannerLogo4Black.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp
    <div class="logo-container">
        <img src="{{ $base64 }}" alt="OTC Banner Logo" class="logo">
    </div>

    <div class="header">
        <h2>{{ $report_type }} Report</h2>
        <p>Region: {{ $region ? $regions[$region] ?? 'Unknown Region' : 'All Regions' }}</p>
        <p>Year: {{ $year ?? 'All Years' }}</p>
        <p>Date Generated: {{ \Carbon\Carbon::parse($generated_at)->format('F d, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Accreditation No.</th>
                <th>Transport Cooperative Name</th>
                <th>CDA Registration No.</th>
                <th>Region</th>
                <th>Accreditation Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($generalInfos as $index => $info)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $info->accreditation_no ?? 'N/A' }}</td>
                    <td>{{ $info->name ?? 'N/A' }}</td>
                    <td>{{ $info->cda_registration_no ?? 'N/A' }}</td>
                    <td>
                        {{ $regions[$info->region] ?? 'N/A' }}
                    </td>
                    <td>{{ $info->accreditation_date ? \Carbon\Carbon::parse($info->accreditation_date)->format('M d, Y') : 'N/A' }}
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

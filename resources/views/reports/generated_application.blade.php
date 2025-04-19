<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ strtoupper(str_replace('_', ' ', request('report_type'))) }} Report</title>
    <style>
        :root {
            --primary-color: #1f4e79;
            --secondary-color: #2e75b6;
            --accent-color: #5b9bd5;
            --border-color: #bdd7ee;
            --header-bg: #f2f6fc;
            --text-dark: #2c3e50;
            --text-medium: #475569;
            --text-light: #64748b;
            --row-alt: #f8fafc;
        }

        @page {
            margin: 0.75in;
        }

        body {
            font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 22pt;
            font-weight: 700;
            margin: 0 0 5px 0;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .header-meta {
            text-align: right;
            font-size: 10pt;
            color: var(--text-medium);
            margin-top: 10px;
        }

        .header-meta span {
            display: inline-block;
            margin-left: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 10pt;
        }

        thead {
            background-color: var(--header-bg);
        }

        th {
            color: var(--primary-color);
            font-weight: 600;
            text-align: left;
            padding: 12px 8px;
            border: 1px solid var(--border-color);
            border-bottom: 2px solid var(--secondary-color);
        }

        td {
            padding: 10px 8px;
            border: 1px solid var(--border-color);
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: var(--row-alt);
        }

        .empty-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: var(--text-light);
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .user-info {
            background-color: var(--header-bg);
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid var(--accent-color);
        }

        .user-info h3 {
            font-size: 14pt;
            margin: 0 0 10px 0;
            color: var(--primary-color);
        }

        .user-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .user-info-item {
            margin-bottom: 5px;
        }

        .user-info-label {
            font-weight: 600;
            color: var(--text-medium);
        }

        .report-timestamp {
            font-size: 9pt;
            color: var(--text-light);
            text-align: center;
            margin-top: 20px;
            font-style: italic;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ strtoupper(str_replace('_', ' ', request('report_type'))) }} REPORT</h1>
        <div class="header-meta">
            <span>Generated: {{ now()->format('F j, Y') }}</span>
            <span>Time: {{ now()->format('h:i A') }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Cooperative Name</th>
                <th width="15%">CDA Registration No.</th>
                <th width="15%">Registration Date</th>
                <th width="10%">Region</th>
                <th width="15%">Status</th>
                <th width="15%">Submitted On</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cooperatives as $index => $coop)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $coop->tc_name }}</strong></td>
                    <td>{{ $coop->cda_reg_no }}</td>
                    <td>{{ $coop->cda_reg_date ? \Carbon\Carbon::parse($coop->cda_reg_date)->format('F j, Y') : 'N/A' }}</td>
                    <td>{{ $coop->region }}</td>
                    <td>
                        <span style="
                            display: inline-block;
                            padding: 2px 8px;
                            border-radius: 3px;
                            font-size: 9pt;
                            font-weight: 600;
                            background-color: {{ 
                                strtolower($coop->status) === 'approved' ? '#d1fae5' : 
                                (strtolower($coop->status) === 'pending' ? '#fef3c7' : 
                                (strtolower($coop->status) === 'rejected' ? '#fee2e2' : '#e5e7eb'))
                            }};
                            color: {{ 
                                strtolower($coop->status) === 'approved' ? '#065f46' : 
                                (strtolower($coop->status) === 'pending' ? '#92400e' : 
                                (strtolower($coop->status) === 'rejected' ? '#b91c1c' : '#374151'))
                            }};
                        ">
                            {{ ucfirst($coop->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($coop->created_at)->format('F j, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-data">No cooperative data available for this report.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="user-info">
            <h3>Report Generated By</h3>
            <div class="user-info-grid">
                <div class="user-info-item">
                    <span class="user-info-label">Employee ID:</span> 
                    {{ $user->employee_id_no }}
                </div>
                <div class="user-info-item">
                    <span class="user-info-label">Name:</span> 
                    {{ $user->firstname }} {{ $user->lastname }}
                </div>
                <div class="user-info-item">
                    <span class="user-info-label">Division:</span> 
                    {{ $user->division }}
                </div>
                <div class="user-info-item">
                    <span class="user-info-label">Role:</span> 
                    {{ $user->role }}
                </div>
                <div class="user-info-item">
                    <span class="user-info-label">Email:</span> 
                    {{ $user->email }}
                </div>
            </div>
        </div>
        <div class="report-timestamp">
            This report was automatically generated on {{ now()->format('l, F j, Y') }} at {{ now()->format('h:i:s A') }}
        </div>
    </div>
</body>

</html>
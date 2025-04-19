<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Cooperative Name</th>
            <th>CDA Registration No.</th>
            <th>Registration Date</th>
            <th>Region</th>
            <th>Status</th>
            <th>Submitted On</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cooperatives as $index => $coop)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $coop->tc_name }}</td>
                <td>{{ $coop->cda_reg_no }}</td>
                <td>{{ $coop->cda_reg_date ? \Carbon\Carbon::parse($coop->cda_reg_date)->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ $coop->region }}</td>
                <td>{{ ucfirst($coop->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($coop->created_at)->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

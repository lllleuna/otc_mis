<div class="container mx-auto px-4 py-8 max-w-6xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Accreditation Report
    </h2>

    <p class="mb-4">
        @if ($region)
            Region: {{ $region }}
        @else
            All Regions
        @endif
    </p>

    <table class="w-full border-collapse shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-4 py-2 text-left">Accreditation No</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Accreditation Date</th>
                <th class="px-4 py-2 text-left">Region</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cooperatives as $coop)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $coop->accreditation_no }}</td>
                    <td class="px-4 py-2">{{ $coop->name }}</td>
                    <td class="px-4 py-2">{{ date('M d, Y', strtotime($coop->accreditation_date)) }}</td>
                    <td class="px-4 py-2">{{ $coop->region }}</td>
                    <td class="px-4 py-2 {{ $coop->status == 'Active' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $coop->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

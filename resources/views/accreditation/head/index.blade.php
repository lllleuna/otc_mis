<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Accreditation Applications</x-slot:title>

    <x-side-nav-approval />

    <div class="ml-64 p-6 bg-gray-50 min-h-screen">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6 flex items-center">
                @php
                    $statusLabels = [
                        'new' => 'New Applications',
                        'saved' => 'In Evaluation',
                        'evaluated' => 'Waiting Approval',
                        'approved' => 'Approved Applications',
                        'released' => 'Released Certificates',
                        'rejected' => 'Rejected Applications',
                    ];
                    $statusTooltips = [
                        'evaluated' => 'Applications waiting for your approval decision.',
                        'approved' => 'Applications approved, pending certificate release.',
                        'released' => 'Applications with certificates already issued.',
                        'rejected' => 'Applications that did not meet requirements.',
                    ];
                    $currentStatus =
                        request()->query('status') ??
                        (request()->has('search') ? session('last_status', 'new') : 'new');
                    echo $statusLabels[$currentStatus] ?? 'All Applications';
                    $currentTooltip = $statusTooltips[$currentStatus] ?? 'View applications by status category.';
                @endphp
                <span class="ml-2 relative group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 cursor-help" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span
                        class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-2 px-3 -mt-2 left-7 w-56">
                        {{ $currentTooltip }}
                    </span>
                </span>
            </h1>

            <div class="mb-6">
                <form method="GET" action="{{ route('accreditation.approval.index') }}" class="flex space-x-2">
                    <input type="hidden" name="status" value="{{ $currentStatus }}">
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search by Reference No."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-150 ease-in-out">
                        Search
                    </button>
                    @if (request('search'))
                        <a href="{{ route('accreditation.approval.index', ['status' => $currentStatus]) }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition duration-150 ease-in-out">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($applications->isEmpty())
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No applications found</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ request('search') ? 'No results matching your search criteria.' : 'There are no applications in this category yet.' }}
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Reference No.</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Cooperative Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Region</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Type</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($applications as $application)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $application->reference_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $application->tc_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 region-name"
                                        data-region="{{ $application->region }}">
                                        {{ $application->region }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ ucwords($application->application_type) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'new' => 'bg-blue-100 text-blue-800', // submitted
                                                'saved' => 'bg-yellow-100 text-yellow-800', // now mapped to "Pending"
                                                'evaluated' => 'bg-purple-100 text-purple-800',
                                                'approved' => 'bg-green-100 text-green-800',
                                                'released' => 'bg-orange-100 text-orange-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusClass =
                                                $statusClasses[$application->status] ?? 'bg-gray-100 text-gray-800';

                                            // Custom label for specific statuses
                                            if ($application->status === 'saved') {
                                                $statusLabel = 'Pending';
                                            } elseif ($application->status === 'evaluated') {
                                                $statusLabel = 'Authenticated';
                                            } else {
                                                $statusLabel = ucfirst($application->status);
                                            }
                                        @endphp
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        @if ($application->status === 'new' || $application->status === 'saved')
                                            <a href="{{ route('accreditation.evaluate', $application->id) }}"
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                                                Evaluate
                                            </a>
                                        @elseif ($application->status === 'evaluated')
                                            <a href="{{ route('accreditation.approval', $application->id) }}"
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                                                View
                                            </a>
                                        @elseif ($application->status === 'approved')
                                            <a href="{{ route('applications.history', $application->id) }}"
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                                                View
                                            </a>
                                        @elseif ($application->status === 'approved' && Auth::user()->role !== 'Admin')
                                            <a href="{{ route('accreditation.release', $application->id) }}"
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                                                Release Certificate
                                            </a>
                                        @elseif ($application->status === 'released' || $application->status === 'rejected')
                                            <a href="{{ route('applications.history', $application->id) }}"
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                                                View
                                            </a>
                                        @else
                                            <span class="text-gray-500">N/A</span>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $applications->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('https://psgc.gitlab.io/api/regions/')
                .then(response => response.json())
                .then(data => {
                    const regionMap = {};
                    data.forEach(region => {
                        regionMap[region.code] = region.name;
                    });

                    document.querySelectorAll('.region-name').forEach(el => {
                        const code = el.dataset.region;
                        el.textContent = regionMap[code] || code;
                    });
                })
                .catch(error => {
                    console.error('Error fetching regions:', error);
                });
        });
    </script>
</x-layout>

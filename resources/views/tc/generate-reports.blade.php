<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Generate Report</x-slot:title>

    <div class="py-8 px-4 md:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">OTC MIS Reports</h2>
            <p class="text-gray-600">Generate monthly, quarterly, and annual reports for transportation cooperatives</p>
        </div>

        <!-- Report Generator Card -->
        <div class="bg-gray-50 rounded-lg shadow-md mb-8">
            <div class="bg-gray-100 text-black p-4 rounded-t-lg">
                <h4 class="font-medium">Report Generation</h4>
            </div>

            <div class="p-6 bg-gray-60">
                <form id="reportForm" action="{{ route('reports.generate.submit') }}" method="POST">
                    @csrf
                    <!-- Report Type and Period -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="report_type" class="block text-sm font-medium text-gray-700 mb-2">Report
                                Type</label>
                            {{-- based on status column in GEneralInfo model if it is active --}}
                            <select id="report_type" name="report_type"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="" selected disabled>Select Report Type</option>
                                <option value="accredited">Accredited Transportation Cooperatives</option>
                            </select>
                        </div>

                    </div>

                    <!-- Time Period Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            {{-- based on created_at column in GeneralInfo model, year only --}}
                            <select id="year" name="year"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    </div>

                    <!-- Region and Format Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700 mb-2">Region
                                (Optional)</label>
                            {{-- based on region column in GEneralInfo model which is stored in databse as a code --}}
                            <select id="region" name="region"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Regions</option>
                            </select>
                        </div>

                        <div>
                            <label for="format" class="block text-sm font-medium text-gray-700 mb-2">Export
                                Format</label>
                            <div class="flex space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="pdf"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                    <span class="ml-2">PDF</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="excel"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2">Excel</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between mt-8">
                        <button type="reset"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Clear Filters
                        </button>
                        <button type="submit" id="generateBtn"
                            class="px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-600 transition-colors">
                            Generate Report
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reports List Card -->
        <div class="bg-gray-60 rounded-lg shadow-md">
            <div class="p-4 bg-gray-100 rounded-t-lg border-b">
                <div class="flex flex-col md:flex-row justify-between md:items-center">
                    <h5 class="font-medium mb-4 md:mb-0">Generated Reports</h5>
                    <div class="relative">
                        <div class="flex">
                            <input type="text" placeholder="Search reports"
                                class="w-full md:w-64 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-100 text-gray-600 rounded-r-md hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Report Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Report Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date Generated</th>
                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User</th> --}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($reportHistories as $history)
                            <tr class="hover:bg-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $history->file_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ ucfirst($history->report_type) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $history->year ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($history->generated_at)->format('M d, Y') }}
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $history->admin->id ?? 'Admin' }}
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex gap-2">

                                    <a href="{{ route('reports.download', $history->id) }}" 
                                       class="text-blue-600 hover:underline"
                                       target="_blank">
                                        Download
                                    </a>
                                
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No reports
                                    generated yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination links --}}
                <div class="p-4">
                    {{ $reportHistories->links() }}
                </div>
            </div>

        </div>
    </div>

    @include('components.footer')

    <script>
        const regionSelect = document.getElementById('region');

        // Fetch regions from PSGC API
        fetch('https://psgc.gitlab.io/api/regions/')
            .then(response => response.json())
            .then(data => {
                data.forEach(region => {
                    const option = document.createElement('option');
                    option.value = region.code; // or region.name if you prefer name as value
                    option.textContent = region.name;
                    regionSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching regions:', error);
            });
    </script>
</x-layout>

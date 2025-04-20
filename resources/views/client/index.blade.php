<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            Transporation Cooperatives
            <span class="ml-2 relative group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-64">
                    This page shows all registered transportation cooperatives with their accreditation details.
                </span>
            </span>
        </h2>

        <!-- Search & Filter Controls -->
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="md:w-1/2 relative group">
                <input type="text" id="searchInput"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                    placeholder="Search by Accreditation No, City, or Email">

            </div>
            <div class="md:w-1/3 relative group">
                <select id="regionFilter"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors appearance-none bg-white">
                    <option value="">All Region</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region['name'] }}">{{ $region['name'] }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr class="text-blue-900">
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider flex items-center">
                            Accreditation No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">TC Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Region</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider flex items-center">
                            Accreditation Date
                            <span class="ml-1 relative group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-700 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-5 w-48">
                                    Date when the cooperative received OTC accreditation.
                                </span>
                            </span>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="infoTable">
                    @forelse ($generalInfos as $info)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $info->accreditation_no ?? 'No Accreditation No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $info->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"> {{ $info->region }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $info->email }} <br>
                                {{ $info->contact_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($info->accreditation_date)->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium relative group">
                                @if ($info->accreditation_no)
                                    <a href="{{ route('general-info.show', ['accreditation_no' => $info->accreditation_no]) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        View
                                    </a>
                                    <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 ml-1 -mt-1 w-44">
                                        View detailed information about this cooperative.
                                    </span>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No
                                records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $generalInfos->links() }}
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const regionFilter = document.getElementById("regionFilter");
            const tableRows = document.querySelectorAll("#infoTable tr");

            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                const selectedRegion = regionFilter.value;

                tableRows.forEach(row => {
                    const accreditationNo = row.cells[0]?.textContent.toLowerCase() || '';
                    const city = row.cells[3]?.textContent.toLowerCase() || '';
                    const email = row.cells[4]?.textContent.toLowerCase() || '';
                    const regionName = row.cells[2]?.textContent.trim().toLowerCase() || '';

                    const matchesSearch = accreditationNo.includes(searchText) || city.includes(
                        searchText) || email.includes(searchText);
                    const matchesRegion = selectedRegion === "" || regionName === selectedRegion
                        .toLowerCase();

                    row.style.display = matchesSearch && matchesRegion ? "" : "none";
                });
            }

            searchInput.addEventListener("input", filterTable);
            regionFilter.addEventListener("change", filterTable);
        });
    </script>
</x-layout>

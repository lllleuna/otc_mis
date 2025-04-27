<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Transporation Cooperatives</h2>

        <!-- Search & Filter Controls -->
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="md:w-1/2">
                <input type="text" id="searchInput"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                    placeholder="Search by Accreditation No, City, or Email">
            </div>
            <div class="md:w-1/3">
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
                        <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Accreditation No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">TC Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Region</th>
                        <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Accreditation Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="infoTable">
                    @forelse ($generalInfos as $info)
                        <tr class="hover:bg-gray-50 transition-colors hidden">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $info->accreditation_no ?? 'No Accreditation No' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $info->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $info->region }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $info->email }}<br>{{ $info->contact_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($info->accreditation_date)->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if ($info->accreditation_no)
                                    <a href="{{ route('general-info.show', ['accreditation_no' => $info->accreditation_no]) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        View
                                    </a>
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
                const searchText = searchInput.value.trim().toLowerCase();
                const selectedRegion = regionFilter.value.toLowerCase();
                let hasMatch = false;

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    if (cells.length === 0) return; // Skip "no records" row

                    const accreditationNo = cells[0]?.textContent.toLowerCase() || '';
                    const name = cells[1]?.textContent.toLowerCase() || '';
                    const regionName = cells[2]?.textContent.toLowerCase() || '';
                    const contact = cells[3]?.textContent.toLowerCase() || '';

                    const matchesSearch = accreditationNo.includes(searchText) || name.includes(
                        searchText) || contact.includes(searchText);
                    const matchesRegion = selectedRegion === "" || regionName === selectedRegion;

                    if (searchText !== "" || selectedRegion !== "") {
                        if (matchesSearch && matchesRegion) {
                            row.classList.remove("hidden");
                            hasMatch = true;
                        } else {
                            row.classList.add("hidden");
                        }
                    } else {
                        row.classList.add("hidden"); // Hide all if no search/filter
                    }
                });

                // Optional: Handle "No Records" text visibility if needed
            }

            searchInput.addEventListener("input", filterTable);
            regionFilter.addEventListener("change", filterTable);
        });
    </script>

</x-layout>

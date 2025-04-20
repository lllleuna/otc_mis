<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Dashboard</x-slot:title>

    <div id="printableArea" class="container mx-auto px-4 pt-5">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">OTC Dashboard</h1>

        <!-- Summary Cards - Updated with specific metrics -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 flex items-center">
                OTC Performance Summary
                <span class="ml-2 relative group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-64">
                        Key metrics showing total accredited cooperatives and current application volume.
                    </span>
                </span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-2">
                <!-- Accredited Transport Cooperatives -->
                <div class="bg-blue-100 p-4 rounded-md">
                    <h3 class="font-semibold text-blue-700 flex items-center">
                        Accredited Transport Cooperatives
                        <span class="ml-2 relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-56">
                                Total cooperatives with active OTC accreditation certificates.
                            </span>
                        </span>
                    </h3>
                    <p class="text-xl font-bold text-gray-800">
                        @if ($generalInfoCount && $generalInfoCount > 0)
                            {{ $generalInfoCount }}
                        @else
                            <span class="text-red-600">No data available</span>
                        @endif
                    </p>
                    <p class="text-sm text-gray-600">Across All Regions</p>
                </div>

                <!-- Active Applications -->
                <div class="bg-green-100 p-4 rounded-md">
                    <h3 class="font-semibold text-green-700 flex items-center">
                        Active Applications
                        <span class="ml-2 relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-56">
                                Applications currently in review or approval process.
                            </span>
                        </span>
                    </h3>
                    <p class="text-xl font-bold text-gray-800">
                        @if ($applicationCount && $applicationCount > 0)
                            {{ $applicationCount }}
                        @else
                            <span class="text-red-600">No data available</span>
                        @endif
                    </p>
                    <p class="text-sm text-gray-600">Accreditation and CGS Renewal</p>
                </div>
            </div>
        </div>


        <!-- Year Filter -->
        <div class="mb-4 hidden">
            <label for="yearFilter" class="text-gray-700 font-semibold">Select Year:</label>
            <select id="yearFilter" class="border rounded px-2 py-1">
                @for ($i = date('Y'); $i >= 2020; $i--)
                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <!-- 1st ROW -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    TC per Regions
                    <span class="ml-2 relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-60">
                            Regional distribution breakdown of active cooperatives.
                        </span>
                    </span>
                </h2>
                <div id="regionsChart" class="w-full h-full"></div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    CGS Renewals Per Year
                    <span class="ml-2 relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-60">
                            Yearly trend showing certificate renewal applications.
                        </span>
                    </span>
                </h2>
                <div id="cgsChart" class="w-full h-full"></div>
            </div>
        </div>

        <!-- 2nd ROW -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden mb-6" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    Accreditation Status
                    <span class="ml-2 relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-60">
                            Current distribution of applications in each approval stage.
                        </span>
                    </span>
                </h2>
                <div id="accreditationChart" class="w-full h-full"></div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden mb-6" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    CGS Renewal Status
                    <span class="ml-2 relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-2 left-6 w-60">
                            Status breakdown of ongoing certificate renewal applications.
                        </span>
                    </span>
                </h2>
                <div id="renewalChart" class="w-full h-full"></div>
            </div>
        </div>
    </div>

    <div class="flex justify-end mb-4 mr-2">
        <button onclick="printDiv('printableArea')"
            class="flex items-center gap-2 px-5 py-2 bg-blue-900 text-white rounded hover:bg-blue-800 relative group">
            <!-- Heroicon: Printer -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 9V4h12v5m-6 4h6v6H6v-6h6zM6 14v2m0 0h12m0 0v-2" />
            </svg>
            Print Analytics
            <span class="absolute z-10 invisible group-hover:visible bg-gray-800 text-white text-xs rounded py-1 px-2 -mt-16 -ml-16 w-40">
                Generate printable report of all dashboard metrics.
            </span>
        </button>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        function printDiv(divId) {
            const printContents = document.getElementById(divId).innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Reload the page after printing to restore JS functionalities (e.g., ApexCharts)
            window.location.reload();
        }

        function fetchChartData(year) {
            fetch(`/dashboard/charts?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    renderBarChart('regionsChart', 'TC per Regions', data.regions.map(r => r.region), data.regions.map(
                        r => r.total));
                    renderBarChart('cgsChart', 'CGS Renewals Per Year', data.cgs.map(c => c.year), data.cgs.map(c => c
                        .total));
                    renderPieChart('accreditationChart', 'Accreditation Status', data.accreditation);
                    renderPieChart('renewalChart', 'CGS Renewal Status', data.renewal);
                });
        }

        function renderBarChart(id, title, categories, series) {
            new ApexCharts(document.querySelector(`#${id}`), {
                chart: {
                    type: 'bar',
                    height: 250
                },
                series: [{
                    name: title,
                    data: series
                }],
                xaxis: {
                    categories: categories
                },
                colors: ['#536493', '#E88D67', '#FCDE70', '#6AAB9C', '#C370A8', '#A35D6A'],
            }).render();
        }

        function renderPieChart(id, title, data) {
            const statusColors = {
                'new': '#5F99AE', // Blue
                'saved': '#FCDE70', // Yellow
                'evaluated': '#E88D67', // Orange
                'approved': '#6AAB9C', // Green
                'rejected': '#9F5255', // Red
                'released': '#FBF4DB' // Cream
            };

            // Map the statuses to the colors in the `statusColors` object
            const colors = data.map(d => statusColors[d.status.toLowerCase()] ||
                '#A35D6A'); // Default color if status is missing

            new ApexCharts(document.querySelector(`#${id}`), {
                chart: {
                    type: 'pie',
                    height: 250
                },
                series: data.map(d => d.total),
                labels: data.map(d => d.status),
                colors: colors,
            }).render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchChartData(new Date().getFullYear());

            document.getElementById('yearFilter').addEventListener('change', function() {
                fetchChartData(this.value);
            });
        });
    </script>
</x-layout>

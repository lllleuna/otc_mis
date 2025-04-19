<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Dashboard</x-slot:title>
    {{-- okay --}}
    <div id="printArea" class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">OTC Dashboard</h1>

        <!-- Summary Cards - Updated with specific metrics -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">OTC Performance Summary</h2>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-2">
                <!-- Accredited Transport Cooperatives -->
                <div class="bg-blue-100 p-4 rounded-md">
                    <h3 class="font-semibold text-blue-700">Accredited Transport Cooperatives</h3>
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
                    <h3 class="font-semibold text-green-700">Active Applications</h3>
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
                <h2 class="text-lg font-semibold text-gray-700">TC per Regions</h2>
                <div id="regionsChart" class="w-full h-full"></div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700">CGS Renewals Per Year</h2>
                <div id="cgsChart" class="w-full h-full"></div>
            </div>
        </div>

        <!-- 2nd ROW -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden mb-6" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700">Accreditation Status</h2>
                <div id="accreditationChart" class="w-full h-full"></div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden mb-6" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700">CGS Renewal Status</h2>
                <div id="renewalChart" class="w-full h-full"></div>
            </div>
        </div>
    </div>

    <button onclick="printDashboard()" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Print Analytics
    </button>


    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        function printDashboard() {
            const content = document.getElementById('printArea').innerHTML;
            const printWindow = window.open('', '', 'height=800,width=1000');
            printWindow.document.write(`
            <html>
                <head>
                    <title>Print Dashboard</title>
                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                </head>
                <body class="bg-white text-gray-900 p-6">
                    ${content}
                </body>
            </html>
        `);
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => printWindow.print(), 500); // allow time to render
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
                colors: colors, // Apply the specific colors based on status
            }).render();
        }

        document.getElementById('yearFilter').addEventListener('change', function() {
            fetchChartData(this.value);
        });

        fetchChartData(new Date().getFullYear());
    </script>


</x-layout>

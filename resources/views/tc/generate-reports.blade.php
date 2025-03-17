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
                <form id="reportForm">
                    <!-- Report Type and Period -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="report_type" class="block text-sm font-medium text-gray-700 mb-2">Report Type</label>
                            <select id="report_type" name="report_type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="" selected disabled>Select Report Type</option>
                                <option value="accredited">Accredited Transportation Cooperatives</option>
                                <option value="renewal">Renewal Applications</option>
                                <option value="good_standing">Issued Certificate of Good Standing</option>
                                <option value="operational">Operational/Active TC</option>
                                <option value="inactive">Inactive/Not Operational TC</option>
                            </select>
                        </div>

                        <div>
                            <label for="report_period" class="block text-sm font-medium text-gray-700 mb-2">Report Period</label>
                            <select id="report_period" name="report_period" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="" selected disabled>Select Period</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="annually">Annually</option>
                            </select>
                        </div>
                    </div>

                    <!-- Time Period Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div id="monthly-options" class="hidden">
                            <label for="month" class="block text-sm font-medium text-gray-700 mb-2">Month</label>
                            <select id="month" name="month" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div id="quarterly-options" class="hidden">
                            <label for="quarter" class="block text-sm font-medium text-gray-700 mb-2">Quarter</label>
                            <select id="quarter" name="quarter" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="1">Q1 (Jan-Mar)</option>
                                <option value="2">Q2 (Apr-Jun)</option>
                                <option value="3">Q3 (Jul-Sep)</option>
                                <option value="4">Q4 (Oct-Dec)</option>
                            </select>
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <select id="year" name="year" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
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
                            <label for="region" class="block text-sm font-medium text-gray-700 mb-2">Region (Optional)</label>
                            <select id="region" name="region" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Regions</option>
                                <option value="NCR">NCR</option>
                                <option value="CAR">CAR</option>
                                <option value="Region 1">Region 1</option>
                                <option value="Region 2">Region 2</option>
                                <option value="Region 3">Region 3</option>
                                <option value="Region 4A">Region 4A</option>
                                <option value="Region 4B">Region 4B</option>
                                <option value="Region 5">Region 5</option>
                                <option value="Region 6">Region 6</option>
                                <option value="Region 7">Region 7</option>
                                <option value="Region 8">Region 8</option>
                                <option value="Region 9">Region 9</option>
                                <option value="Region 10">Region 10</option>
                                <option value="Region 11">Region 11</option>
                                <option value="Region 12">Region 12</option>
                                <option value="Region 13">Region 13</option>
                            </select>
                        </div>

                        <div>
                            <label for="format" class="block text-sm font-medium text-gray-700 mb-2">Export Format</label>
                            <div class="flex space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="pdf" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                                    <span class="ml-2">PDF</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="format" value="excel" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2">Excel</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between mt-8">
                        <button type="reset" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Clear Filters
                        </button>
                        <button type="button" id="generateBtn" class="px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-600 transition-colors">
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
                            <input type="text" placeholder="Search reports" class="w-full md:w-64 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-100 text-gray-600 rounded-r-md hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Generated</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Accredited_TC_Report_Jan_2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Accredited Transportation Cooperatives</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">January 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Mar 10, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button class="px-2 py-1 bg-blue-900 text-white rounded hover:bg-blue-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </button>
                                    <button class="px-2 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Operational_TC_Q4_2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Operational/Active TC</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Q4 2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 05, 2025</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button class="px-2 py-1 bg-blue-900 text-white rounded hover:bg-blue-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </button>
                                    <button class="px-2 py-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-500">Showing 2 of 2 reports</p>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded bg-gray-100 text-gray-600 hover:bg-gray-200" disabled>Previous</button>
                        <button class="px-3 py-1 border rounded bg-gray-100 text-gray-600 hover:bg-gray-200" disabled>Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to show/hide the appropriate period selection fields
        document.addEventListener('DOMContentLoaded', function() {
            const reportPeriodSelect = document.getElementById('report_period');
            const monthlyOptions = document.getElementById('monthly-options');
            const quarterlyOptions = document.getElementById('quarterly-options');

            reportPeriodSelect.addEventListener('change', function() {
                // Hide all options first
                monthlyOptions.classList.add('hidden');
                quarterlyOptions.classList.add('hidden');

                // Show the appropriate options based on selection
                if (this.value === 'monthly') {
                    monthlyOptions.classList.remove('hidden');
                } else if (this.value === 'quarterly') {
                    quarterlyOptions.classList.remove('hidden');
                }
            });

            // Generate report button functionality
            const generateBtn = document.getElementById('generateBtn');
            generateBtn.addEventListener('click', function() {
                // Here you would add the logic to generate and download reports
                alert('Report generation initiated. Your report will be available shortly.');
                // In a real application, you would submit the form or make an AJAX request
            });
        });
    </script>
</x-layout>

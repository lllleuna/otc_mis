<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Reports</x-slot:title>

    <div class="">
        <div class="bg-white rounded-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <h2 class="text-2xl font-bold text-black">Report Generation</h2>
                <p class="text-gray-600 mt-1">Generate customized reports based on your criteria</p>
            </div>

            <form action="{{ route('report.generate') }}" method="GET" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Report Type Selection -->
                    <div class="space-y-2">
                        <label for="report_type" class="block text-sm font-medium text-gray-700">Report Type</label>
                        <div class="relative">
                            <select id="report_type" name="report_type"
                                class="w-full pl-4 pr-10 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors appearance-none">
                                <option value="accreditation">Accreditation Report</option>
                                <option value="cgs">CGS Report</option>
                            </select>
                        </div>
                    </div>

                    <!-- Region Selection -->
                    <div class="space-y-2">
                        <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                        <div class="relative">
                            <select id="region" name="region"
                                class="w-full pl-4 pr-10 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors appearance-none">
                                <option value="">All Regions</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region['name'] }}">{{ $region['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Year Selection -->
                    <div class="space-y-2">
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <div class="relative">
                            <select id="year" name="year"
                                class="w-full pl-4 pr-10 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors appearance-none">
                                <option value="">All Years</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Export Format Selection -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Export Format</label>
                        <div class="grid grid-cols-2 gap-3">
                            <!-- PDF Option -->
                            <div class="relative">
                                <input type="radio" id="format_pdf" name="format" value="pdf"
                                    class="absolute opacity-0 w-0 h-0" checked>
                                <label for="format_pdf"
                                    class="z-10 flex items-center justify-center p-3 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition-all duration-200 block w-full">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-6 h-6 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="font-medium">PDF</span>
                                    </div>
                                </label>
                                <!-- Selection indicator that shows/hides based on state -->
                                <div
                                    class="absolute inset-0 rounded-lg ring-2 ring-blue-500 bg-blue-100 bg-opacity-40 pointer-events-none hidden radio-selected z-0">
                                </div>
                            </div>

                            <!-- Excel Option -->
                            <div class="relative">
                                <input type="radio" id="format_excel" name="format" value="excel"
                                    class="absolute opacity-0 w-0 h-0">
                                <label for="format_excel"
                                    class="z-10 flex items-center justify-center p-3 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 transition-all duration-200 block w-full">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-6 h-6 mr-2 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="font-medium">Excel</span>
                                    </div>
                                </label>
                                <!-- Selection indicator that shows/hides based on state -->
                                <div
                                    class="absolute inset-0 rounded-lg ring-2 ring-blue-500 bg-blue-100 bg-opacity-40 pointer-events-none hidden radio-selected z-0">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-900 text-white font-semibold rounded-lg shadow-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Generate Report
                    </button>
                </div>

            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all radio inputs
            const radioInputs = document.querySelectorAll('input[type="radio"][name="format"]');

            // Function to update the selected state
            function updateSelectedState() {
                radioInputs.forEach(input => {
                    const container = input.closest('.relative');
                    const indicator = container.querySelector('.radio-selected');

                    if (input.checked) {
                        indicator.classList.remove('hidden');
                    } else {
                        indicator.classList.add('hidden');
                    }
                });
            }

            // Add change event listeners to all radio inputs
            radioInputs.forEach(input => {
                input.addEventListener('change', updateSelectedState);
            });

            // Initialize on page load
            updateSelectedState();
        });
    </script>
</x-layout>

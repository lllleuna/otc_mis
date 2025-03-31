<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Reports</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Select Accreditation Report</h2>

        <form action="{{ route('report.generate') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Accreditation Type Selection -->
                <div>
                    <label for="report_type" class="block text-sm font-medium text-gray-700">Report Type</label>
                    <select id="report_type" name="report_type"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors">
                        <option value="">Select Report</option>
                        <option value="summary">Summary</option>
                        <option value="detailed">Detailed</option>
                    </select>
                </div>

                <!-- Region Selection -->
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                    <select id="region" name="region"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors">
                        <option value="">All Regions</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region['name'] }}">{{ $region['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Export Format Selection -->
                <div>
                    <label for="format" class="block text-sm font-medium text-gray-700">Export Format</label>
                    <select id="format" name="format"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors">
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Generate Report
                </button>
            </div>
        </form>
    </div>

</x-layout>

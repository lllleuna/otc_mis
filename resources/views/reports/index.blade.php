<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Reports</x-slot:title>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Generate Report</h2>

        <form action="{{ route('reports.generate') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Report Type Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Select Report</label>
                    <select name="report_type" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="accredited">Accredited Cooperatives</option>
                        <option value="newly_accredited">Newly Accredited Cooperatives</option>
                        <option value="active">Active Cooperatives</option>
                        <option value="inactive">Inactive Cooperatives</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Status</label>
                    <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="">All</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <!-- Accreditation Date Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Accreditation Date (Year)</label>
                    <input type="number" name="accreditation_date"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="e.g. 2023">
                </div>

                <!-- Export Format -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Export Format</label>
                    <select name="format" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="pdf">PDF</option>
                        <option value="excel">Excel</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md">
                    Generate Report
                </button>
            </div>
        </form>
    </div>

</x-layout>

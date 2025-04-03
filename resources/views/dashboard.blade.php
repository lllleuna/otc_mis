<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">OTC Dashboard</h1>

        {{-- // --}}

        <!-- 1st ROW -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Total Accredited Transporation Cooperatives Per Regions -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <div class="flex justify-between items-center ">
                    <h2 class="text-lg font-semibold text-gray-700">TC per Regions</h2>
                </div>
                <div id="regionsChart" class="w-full h-full"></div>
            </div>

            <!-- Total No. of CGS Renewals Per Year -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <div class="flex justify-between items-center ">
                    <h2 class="text-lg font-semibold text-gray-700">CGS Renewals Per Year</h2>
                </div>
                <div id="cgsChart" class="w-full h-full"></div>
            </div>
        </div>

        {{-- 2nd ROW --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- No. of Applications For Accreditation per Status (new, saved, evaluated, approved, rejected, released) -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <h2 class="text-lg font-semibold text-gray-700">Accreditation Status</h2>
                <div id="accreditationChart" class="w-full h-full"></div>
            </div>

            <!-- No. of Applications For CGS Renewals per Status (new, saved, evaluated, approved, rejected, released) -->
            <div class="bg-white rounded-lg shadow-md p-7 overflow-hidden" style="height: 300px;">
                <div class="flex justify-between items-center ">
                    <h2 class="text-lg font-semibold text-gray-700">CGS Renewal Status</h2>
                </div>
                <div id="renewalChart" class="w-full h-full"></div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</x-layout>

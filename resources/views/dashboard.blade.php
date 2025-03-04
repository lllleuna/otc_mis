<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="container mx-auto">
        <a href="{{ route('backup.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Backup Data
        </a>
        
        <h1 class="text-3xl font-bold mb-6 text-gray-800">OTC Management Dashboard</h1>
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
             <h2 class="text-xl font-semibold mb-4 text-gray-700">Summary</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                  <div class="bg-blue-100 p-4 rounded-md">
                    <h3 class="font-semibold text-blue-700">Active Cooperatives</h3>
                    <p class="text-xl font-bold text-gray-800">150</p>
                 </div>
                 <div class="bg-green-100 p-4 rounded-md">
                   <h3 class="font-semibold text-green-700">Completed Transactions</h3>
                   <p class="text-xl font-bold text-gray-800">230</p>
             </div>
            <div class="bg-yellow-100 p-4 rounded-md">
                 <h3 class="font-semibold text-yellow-700">Pending Registrations</h3>
                 <p class="text-xl font-bold text-gray-800">40</p>
            </div>
     </div>
    </div>
    <div class="mt-8"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white rounded-lg shadow-md p-6" style="height: 350px;">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Transaction Status</h2>
                </div>
                <div id="transactionStatusChart" class="w-full h-full"></div>
            </div>


            <div class="bg-white rounded-lg shadow-md p-6" style="height: 350px;">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Registration Status</h2>
                <div id="registrationStatusChart" class="w-full h-full"></div>
            </div>
        </div>

        <!-- Transportation Cooperative Status - centered at the bottom -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6" style="height: 350px;">
            <h2 class="text-xl font-semibold mb-4 text-gray-700 text-center">Transportation Cooperative Status</h2>
            <div id="transportationStatusChart" class="w-full h-full flex justify-center"></div>
        </div>
    </div>

    <div class="container mx-auto mt-10">

    <div class="container mx-auto mt-10">
    <!-- Report Generation Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Generate Report</h2>
        <p class="text-sm text-gray-500 mb-4">Select the report type and date range for generating a report.</p>

        <!-- Report Type Selection -->
        <div class="flex space-x-6 mb-6">
            <div class="w-1/3">
                <label for="reportType" class="block text-sm font-semibold text-gray-700 mb-2">Report Type</label>
                <select id="reportType" class="block w-full border border-gray-300 rounded-md p-2">
                    <option value="transaction">Transaction Report</option>
                    <option value="registration">Registration Report</option>
                    <option value="cooperative">Cooperative Report</option>
                    <option value="summary">Summary Report</option>
                </select>
            </div>

            <div class="w-1/3">
                <label for="startDate" class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                <input type="date" id="startDate" class="block w-full border border-gray-300 rounded-md p-2">

                <label for="endDate" class="block text-sm font-semibold text-gray-700 mt-4 mb-2">End Date</label>
                <input type="date" id="endDate" class="block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="w-1/3 flex items-end">
                <button class="bg-blue-500 text-white rounded-md p-2 w-full hover:bg-blue-600">
                    Generate Report
                </button>
            </div>
        </div>


        <!-- Action Links (optional) -->
        <div class="mt-4 flex justify-end">
            <button class="bg-green-500 text-white rounded-md p-2 hover:bg-green-600">Download Report</button>
            <button class="bg-yellow-500 text-white rounded-md p-2 ml-4 hover:bg-yellow-600">Send via Email</button>
        </div>
    </div>
</div>


    <!-- Task or Reminder Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Upcoming Tasks & Reminders</h2>
        <div class="space-y-4">
            <!-- Task 1 -->
            <div class="flex items-center justify-between bg-blue-100 p-4 rounded-md">
                <div>
                    <h3 class="font-semibold text-blue-700">Complete Registration Approvals</h3>
                    <p class="text-sm text-gray-600">Deadline: 20th Feb, 2025</p>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Mark as Done</button>
            </div>

            <!-- Task 2 -->
            <div class="flex items-center justify-between bg-yellow-100 p-4 rounded-md">
                <div>
                    <h3 class="font-semibold text-yellow-700">Update Transportation Status</h3>
                    <p class="text-sm text-gray-600">Deadline: 25th Feb, 2025</p>
                </div>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded-md">Mark as Done</button>
            </div>

            <!-- Task 3 -->
            <div class="flex items-center justify-between bg-green-100 p-4 rounded-md">
                <div>
                    <h3 class="font-semibold text-green-700">Generate Monthly Reports</h3>
                    <p class="text-sm text-gray-600">Deadline: 28th Feb, 2025</p>
                </div>
                <button class="bg-green-500 text-white px-4 py-2 rounded-md">Mark as Done</button>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="bg-gray-800 text-white py-4 mt-10">
    <div class="container mx-auto text-center">
        <p>&copy; 2025 Office of Transportation Cooperatives. All rights reserved.</p>
        <p><a href="/privacy-policy" class="text-blue-300 hover:text-blue-500">Privacy Policy</a> | <a href="/terms-of-service" class="text-blue-300 hover:text-blue-500">Terms of Service</a></p>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>

        if (typeof ApexCharts !== 'undefined') {
            // Transaction Status Chart (Sample Data)
            var transactionStatusChart = new ApexCharts(document.getElementById("transactionStatusChart"), {
                series: [
                    { name: 'Evaluated', data: [50, 60, 45, 70, 65, 50, 55, 60, 65, 75, 80, 90] },
                    { name: 'In Progress', data: [30, 20, 25, 15, 30, 35, 40, 45, 50, 55, 60, 65] },
                    { name: 'Completed', data: [20, 25, 30, 25, 25, 20, 25, 30, 35, 40, 45, 50] }
                ],
                chart: {
                    type: 'bar',
                    height: '90%',
                    stacked: false,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '75%',
                        endingShape: 'rounded'
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                legend: { position: 'top' },
                fill: { opacity: .85 }
            });

            // Registration Status Chart (Sample Data)
            var registrationStatusChart = new ApexCharts(document.getElementById("registrationStatusChart"), {
                series: [50, 30, 20],
                chart: {
                    type: 'pie',
                    height: '90%'
                },
                labels: ['Newly Registered', 'CGS Application', 'Training'],
                colors: ['#FCDE70', '#E88D67', '#51829B'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { width: 200 },
                        legend: { position: 'bottom' }
                    }
                }]
            });

            // Transportation Cooperative Status Chart (Sample Data)
            var transportationStatusChart = new ApexCharts(document.getElementById("transportationStatusChart"), {
                series: [60, 40],
                chart: {
                    type: 'pie',
                    height: '90%'
                },
                labels: ['Active', 'Inactive'],
                colors: ['#347928', '#E64848'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { width: 200 },
                        legend: { position: 'bottom' }
                    }
                }]
            });


            transactionStatusChart.render();
            registrationStatusChart.render();
            transportationStatusChart.render();
        }

    </script>
</x-layout>

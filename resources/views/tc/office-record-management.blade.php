<!-- resources/views/transaction-dashboard.blade.php -->
@extends('layouts.transaction-layout')

@section('title', 'Transaction Dashboard')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold mb-2">Transaction Monitoring</h2>
                <p class="text-gray-700">Track all changes and activities for transportation cooperative applications</p>
            </div>
        </div>

        <!-- Filter Controls -->
        <div class="mb-5 bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex flex-wrap gap-6">
                <div class="w-48">
                    <label for="status-filter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3">
                        <option value="all">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="draft">Draft</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="w-48">
                    <label for="type-filter" class="block text-sm font-medium text-gray-700 mb-1">Type of Application</label>
                    <select id="type-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3">
                        <option value="all">All Types</option>
                        <option value="franchise">Accreditation</option>
                        <option value="route">Renewal of Accreditation</option>
                        <option value="vehicle">Issuance of Certificate of Good Standing (CGS)</option>
                    </select>
                </div>
                <div class="w-48">
                    <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <select id="date-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3">
                        <option value="all">All Dates</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button id="apply-filters" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-gray-600 flex items-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Transaction Records Table -->

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref No.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type of Application</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooperative Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Update</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Hardcoded Sample Data -->
                    <tr class="hover:bg-gray-50 cursor-pointer" data-type="franchise" data-status="pending" onclick="viewTransactionDetails('TRX-2024-001')">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-blue-600">TRX-2024-001</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Accreditation</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Bagong Pag-asa Transport Cooperative</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2025-02-22</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            <div class="popover">
                                <button class="text-gray-600 hover:text-gray-800" title="View activity log">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <div class="popover-content p-4 mx-auto">
                                    <div class="text-sm font-medium text-gray-900 mb-2">Activity Log for TRX-2024-001</div>
                                    <div class="space-y-2">
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-22 09:30</span> - <span class="font-medium">Juan Dela Cruz (Applicant)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Submitted initial application with CDA registration, route map, and list of 15 vehicles.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-22 09:45</span> - <span class="font-medium">System</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Application assigned to Evaluator: Maria Garcia.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-22 14:30</span> - <span class="font-medium">Maria Garcia (Evaluator)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Initial review completed. Requested missing financial statement for past 2 years.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 cursor-pointer" data-type="route" data-status="approved" onclick="viewTransactionDetails('TRX-2024-002')">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-blue-600">TRX-2024-002</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Issuance of Certificate of Good Standing (CGS)</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Mabuhay Drivers Transport Cooperative</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2025-02-21</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Approved
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            <div class="popover">
                                <button class="text-gray-600 hover:text-gray-800" title="View activity log">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <div class="popover-content p-4">
                                    <div class="text-sm font-medium text-gray-900 mb-2">Activity Log for TRX-2024-002</div>
                                    <div class="space-y-2">
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-21 09:15</span> - <span class="font-medium">Maria Santos (Coop Manager)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Requested CGS for bank loan application. Uploaded tax clearance and compliance reports.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-21 10:30</span> - <span class="font-medium">John Ramos (Records Officer)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Verified compliance history. No violations in past 24 months. Complete membership payments.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-21 11:15</span> - <span class="font-medium">Patricia Cruz (Legal Officer)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Legal review completed. No pending cases or liabilities found.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-21 14:45</span> - <span class="font-medium">Atty. Santos (Department Head)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Certificate of Good Standing approved and issued. Valid for 1 year.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 cursor-pointer" data-type="vehicle" data-status="draft" onclick="viewTransactionDetails('TRX-2024-003')">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-blue-600">TRX-2024-003</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Renewal of Accreditation</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Bagong Sikap Transport Cooperative</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">2025-02-20</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                Draft
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            <div class="popover">
                                <button class="text-gray-600 hover:text-gray-800" title="View activity log">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <div class="popover-content p-4">
                                    <div class="text-sm font-medium text-gray-900 mb-2">Activity Log for TRX-2024-003</div>
                                    <div class="space-y-2">
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-20 16:30</span> - <span class="font-medium">Pedro Reyes (Coop Secretary)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Started renewal application draft. Current accreditation expires on 2025-04-15.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-20 16:45</span> - <span class="font-medium">Pedro Reyes (Coop Secretary)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Uploaded updated member list (42 members) and vehicle inventory (28 units).
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-20 17:10</span> - <span class="font-medium">Pedro Reyes (Coop Secretary)</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Saved as draft. Pending financial statements and annual general meeting minutes.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


        <!-- Pagination Controls -->
        <div class="mt-4 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Showing <span id="results-from" class="font-medium">1</span> to <span id="results-to" class="font-medium">3</span> of <span id="results-total" class="font-medium">3</span> results
            </div>
            <div class="flex space-x-2">
                <button id="prev-page" class="px-3 py-1 bg-blue-900 text-white rounded hover:bg-gray-600  disabled:opacity-90 flex items-center" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                <button id="next-page" class="px-3 py-1 bg-blue-900 text-white rounded hover:bg-gray-600 disabled:opacity-90 flex items-center" disabled>
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const applyButton = document.getElementById('apply-filters');

            applyButton.addEventListener('click', function() {
                filterResults();
            });

            function filterResults() {
                const statusFilter = document.getElementById('status-filter').value;
                const typeFilter = document.getElementById('type-filter').value;
                const dateFilter = document.getElementById('date-filter').value;

                const rows = document.querySelectorAll('tbody tr[data-type]');
                let visibleCount = 0;

                rows.forEach(row => {
                    let showRow = true;

                    // Type filtering
                    if (typeFilter !== 'all' && row.getAttribute('data-type') !== typeFilter) {
                        showRow = false;
                    }

                    // Status filtering
                    if (statusFilter !== 'all' && row.getAttribute('data-status') !== statusFilter) {
                        showRow = false;
                    }

                    // Date filtering would be more complex, simplified for demo
                    if (dateFilter !== 'all') {
                        // This is a simplified version for demonstration
                        if (dateFilter === 'today' && !row.querySelector('td:nth-child(4)').textContent.includes('2025-02-22')) {
                            showRow = false;
                        } else if (dateFilter === 'week' && !row.querySelector('td:nth-child(4)').textContent.includes('2025-02')) {
                            showRow = false;
                        }
                    }

                    if (showRow) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Update result counter
                document.getElementById('results-from').textContent = visibleCount > 0 ? '1' : '0';
                document.getElementById('results-to').textContent = visibleCount;
                document.getElementById('results-total').textContent = visibleCount;

                // Update pagination buttons
                document.getElementById('prev-page').disabled = true;
                document.getElementById('next-page').disabled = true;
            }

            // Initialize with all rows visible
            filterResults();
        });

        // Function to handle viewing transaction details
        function viewTransactionDetails(transactionId) {
            // This would typically redirect to a detail page
            console.log('Viewing details for transaction:', transactionId);
            // For demonstration purposes:
            // window.location.href = `/transactions/${transactionId}`;
            alert(`Opening details for ${transactionId}`);
        }
    </script>
@endsection

<!-- resources/views/transaction-dashboard.blade.php -->
@extends('layouts.transaction-layout')

@section('title', 'Transaction Dashboard')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold mb-2">Recent Entries</h2>
                <p class="text-gray-700">View the status of transaction records and activities</p>
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
                    <label for="type-filter" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select id="type-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3">
                        <option value="all">All Types</option>
                        <option value="franchise">Franchise Application</option>
                        <option value="route">Route Modification</option>
                        <option value="vehicle">Vehicle Replacement</option>
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Hardcoded Sample Data -->
                    <tr class="hover:bg-gray-50 cursor-pointer" data-type="franchise" data-status="pending" onclick="viewTransactionDetails('TRX-2024-001')">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-blue-600">TRX-2024-001</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Franchise Application</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Juan Dela Cruz</td>
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
                                                    <span class="font-medium">2025-02-22 09:30</span> - Created by <span class="font-medium">Juan Dela Cruz</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Application submitted with required documents.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-22 09:45</span> - System <span class="font-medium">Automation</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Application queued for review.
                                                    Assigned to Processing Department.
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
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Route Modification</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Maria Santos</td>
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
                                                    <span class="font-medium">2025-02-21 09:15</span> - Created by <span class="font-medium">Maria Santos</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Route modification request submitted.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-21 10:30</span> - Reviewed by <span class="font-medium">John Supervisor</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Initial review completed. Recommended for approval.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs text-gray-500">
                                                    <span class="font-medium">2025-02-21 10:45</span> - Approved by <span class="font-medium">Admin User</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Route modification approved. Notification sent to applicant.
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
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Vehicle Replacement</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">Pedro Reyes</td>
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
                                                    <span class="font-medium">2025-02-20 16:30</span> - Drafted by <span class="font-medium">Pedro Reyes</span>
                                                </p>
                                                <p class="text-sm text-gray-700 mt-1">
                                                    Initial draft of vehicle replacement application created.
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

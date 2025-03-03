@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-4">
    <button onclick="window.history.back()" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
        ← Back
    </button>
</div>

<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow">

    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Edit Cooperative Information</h1>
        <p class="text-gray-600">Update information for this transport cooperative</p>
    </div>

    <form id="editCooperativeForm" class="space-y-8">
        <!-- Cooperative Identity Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>
                </span>
                <h2 class="text-lg font-semibold text-gray-800">Cooperative Identity</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="coopName" class="block text-sm font-medium text-gray-700 mb-1">Transport Cooperative Name</label>
                    <input type="text" id="coopName" name="coopName" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="shortName" class="block text-sm font-medium text-gray-700 mb-1">Short Name</label>
                    <input type="text" id="shortName" name="shortName" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="bondMembership" class="block text-sm font-medium text-gray-700 mb-1">Common Bond of Membership</label>
                    <textarea id="bondMembership" name="bondMembership" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="form-group">
                    <label for="membershipFee" class="block text-sm font-medium text-gray-700 mb-1">Membership Fee (per by-laws)</label>
                    <input type="text" id="membershipFee" name="membershipFee" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>
        </div>

        <!-- Registration & Accreditation Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <h2 class="text-lg font-semibold text-gray-800">Registration & Accreditation</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="otcAccNumber" class="block text-sm font-medium text-gray-700 mb-1">OTC Accreditation Number</label>
                    <input type="text" id="otcAccNumber" name="otcAccNumber" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="accType" class="block text-sm font-medium text-gray-700 mb-1">Type of Accreditation</label>
                    <select id="accType" name="accType" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Select type...</option>
                        <option value="Provisional">Provisional</option>
                        <option value="Regular">Regular</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="otcAccDate" class="block text-sm font-medium text-gray-700 mb-1">OTC Accreditation Date</label>
                    <input type="date" id="otcAccDate" name="otcAccDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="coopRegNumber" class="block text-sm font-medium text-gray-700 mb-1">Cooperative Registration Number</label>
                    <input type="text" id="coopRegNumber" name="coopRegNumber" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="cdaRegDate" class="block text-sm font-medium text-gray-700 mb-1">CDA Registration Date</label>
                    <input type="date" id="cdaRegDate" name="cdaRegDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
                <h2 class="text-lg font-semibold text-gray-800">Contact Information</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="areaRegion" class="block text-sm font-medium text-gray-700 mb-1">Area / Region / City / Province / Barangay</label>
                    <input type="text" id="areaRegion" name="areaRegion" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="businessAddress" class="block text-sm font-medium text-gray-700 mb-1">Business Address</label>
                    <textarea id="businessAddress" name="businessAddress" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                </div>
                <div class="form-group">
                    <label for="contactPerson" class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                    <input type="text" id="contactPerson" name="contactPerson" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="contactNumbers" class="block text-sm font-medium text-gray-700 mb-1">Contact Numbers</label>
                    <input type="text" id="contactNumbers" name="contactNumbers" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>
        </div>

        <!-- Government Registrations Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </span>
                <h2 class="text-lg font-semibold text-gray-800">Government Registrations</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="sssNumber" class="block text-sm font-medium text-gray-700 mb-1">SSS Employer Registration Number</label>
                    <input type="text" id="sssNumber" name="sssNumber" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="sssEmployees" class="block text-sm font-medium text-gray-700 mb-1">No. Of SSS Enrolled Employees</label>
                    <input type="number" id="sssEmployees" name="sssEmployees" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="pagibigNumber" class="block text-sm font-medium text-gray-700 mb-1">Pag-IBIG Employer Registration Number</label>
                    <input type="text" id="pagibigNumber" name="pagibigNumber" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="pagibigEmployees" class="block text-sm font-medium text-gray-700 mb-1">No. Of Pag-IBIG Enrolled Employees</label>
                    <input type="number" id="pagibigEmployees" name="pagibigEmployees" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="philhealthNumber" class="block text-sm font-medium text-gray-700 mb-1">PhilHealth Employer Registration Number</label>
                    <input type="text" id="philhealthNumber" name="philhealthNumber" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="philhealthEmployees" class="block text-sm font-medium text-gray-700 mb-1">No. Of PhilHealth Enrolled Employees</label>
                    <input type="number" id="philhealthEmployees" name="philhealthEmployees" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="birTin" class="block text-sm font-medium text-gray-700 mb-1">BIR TIN Number</label>
                    <input type="text" id="birTin" name="birTin" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="taxExemptNumber" class="block text-sm font-medium text-gray-700 mb-1">BIR Tax Exemption Number</label>
                    <input type="text" id="taxExemptNumber" name="taxExemptNumber" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="taxExemptValidity" class="block text-sm font-medium text-gray-700 mb-1">BIR Tax Exemption Validity Date</label>
                    <input type="date" id="taxExemptValidity" name="taxExemptValidity" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>
        </div>

        <!-- Assistance & Management Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <h2 class="text-lg font-semibold text-gray-800">Assistance & Management</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="assessDate" class="block text-sm font-medium text-gray-700 mb-1">Latest Date of Assess and Assist Activity</label>
                    <input type="date" id="assessDate" name="assessDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="form-group">
                    <label for="fmaDate" class="block text-sm font-medium text-gray-700 mb-1">Latest Date of Financial Management Assistance (FMA)</label>
                    <input type="date" id="fmaDate" name="fmaDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>
        </div>

        <!-- Dynamic Forms Section (For units, franchise, employment, etc.) -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <span class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                    <h2 class="text-lg font-semibold text-gray-800">Financial Records</h2>
                </div>
                <button type="button" id="addFinancialRecord" class="px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Record
                    </span>
                </button>
            </div>

            <div id="financialRecords" class="space-y-4">
                <!-- Template for financial record -->
                <div class="financial-record border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-medium text-gray-700">Financial Record - <span class="record-year">2024</span></h3>
                        <button type="button" class="delete-record text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                            <select class="year-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="2025">2025</option>
                                <option value="2024" selected>2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Assets</label>
                            <input type="number" class="total-assets w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Liabilities</label>
                            <input type="number" class="total-liabilities w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Equity</label>
                            <input type="number" class="total-equity w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gross Revenue</label>
                            <input type="number" class="gross-revenue w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Net Surplus</label>
                            <input type="number" class="net-surplus w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Units Section -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <span class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                    </span>
                    <h2 class="text-lg font-semibold text-gray-800">Units</h2>
                </div>
                <button type="button" id="addUnitRecord" class="px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Unit
                    </span>
                </button>
            </div>

            <div id="unitRecords" class="space-y-4">
                <!-- Template for unit record -->
                <div class="unit-record border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-medium text-gray-700">Unit Record</h3>
                        <button type="button" class="delete-unit text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                            <select class="unit-mode w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="PUJ">PUJ</option>
                                <option value="PUB">PUB</option>
                                <option value="UV Express">UV Express</option>
                                <option value="Taxi">Taxi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select class="unit-type w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="Modern">Modern</option>
                                <option value="Traditional">Traditional</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Number of Units</label>
                            <input type="number" class="unit-count w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                            <input type="text" class="unit-brand w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                            <input type="text" class="unit-model w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save Changes
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    document.getElementById('addFinancialRecord').addEventListener('click', function() {
        const financialRecords = document.getElementById('financialRecords');
        const newRecord = document.createElement('div');
        newRecord.className = 'financial-record border border-gray-200 rounded-lg p-4';
        newRecord.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-medium text-gray-700">Financial Record</h3>
                <button type="button" class="delete-record text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <select class="year-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="2025">2025</option>
                        <option value=" 2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Assets</label>
                    <input type="number" class="total-assets w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Liabilities</label>
                    <input type="number" class="total-liabilities w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Equity</label>
                    <input type="number" class="total-equity w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gross Revenue</label>
                    <input type="number" class="gross-revenue w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Net Surplus</label>
                    <input type="number" class="net-surplus w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        `;
        financialRecords.appendChild(newRecord);
    });

    document.getElementById('financialRecords').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-record')) {
            e.target.closest('.financial-record').remove();
        }
    });

    document.getElementById('addUnitRecord').addEventListener('click', function() {
        const unitRecords = document.getElementById('unitRecords');
        const newUnit = document.createElement('div');
        newUnit.className = 'unit-record border border-gray-200 rounded-lg p-4';
        newUnit.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-medium text-gray-700">Unit Record</h3>
                <button type="button" class="delete-unit text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                    <select class="unit-mode w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="PUJ">PUJ</option>
                        <option value="PUB">PUB</option>
                        <option value="UV Express">UV Express</option>
                        <option value="Taxi">Taxi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select class="unit-type w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Modern">Modern</option>
                        <option value=" Traditional">Traditional</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Number of Units</label>
                    <input type="number" class="unit-count w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <input type="text" class="unit-brand w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                    <input type="text" class="unit-model w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        `;
        unitRecords.appendChild(newUnit);
    });

    document.getElementById('unitRecords').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-unit')) {
            e.target.closest('.unit-record').remove();
        }
    });
</script>
@endsection

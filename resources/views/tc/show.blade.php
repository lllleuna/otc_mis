<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Cooperative Details</title>
</head>
<body class="bg-gray-100 min-h-screen p-8"
    x-data="{
        tab: 'general',
        searchQuery: '',
        menus: {
            operations: false,
            financial: false,
            development: false,
            governance: false
        },
        cooperativeData: {
            general: [
                { label: 'Accreditation Number', value: '{{ $generalinfo->accreditation_no }}' },
                { label: 'Transport Cooperative Name', value: '{{ addslashes($generalinfo->name) }}' },
                { label: 'Short Name', value: '{{ addslashes($generalinfo->short_name) }}' },
                { label: 'Type of Accreditation', value: '{{ $generalinfo->accreditation_type }}' },
                { label: 'Accreditation Date', value: '{{ $generalinfo->accreditation_date }}' },
                { label: 'CDA Registration Number', value: '{{ $generalinfo->cda_registration_no }}' },
                { label: 'CDA Registration Date', value: '{{ $generalinfo->cda_registration_date }}' },
                { label: 'Common Bond of Membership', value: '{{ $generalinfo->common_bond_membership }}' },
                { label: 'Membership Fee (per by-laws)', value: '{{ $generalinfo->membership_fee }}' },
                { label: 'Area / Region / City / Province / Barangay', value: '{{ $generalinfo->region }}' },
                { label: 'Business Address', value: '{{ addslashes($generalinfo->business_address) }}' },
                { label: 'Contact Person', value: '{{ $generalinfo->contact_firstname . ' ' . $generalinfo->contact_lastname ?? 'Maria P. Santos' }}' },
                { label: 'E-mail', value: '{{ $generalinfo->email ?? 'info@metrotransportcoop.com' }}' },
                { label: 'Contact Number', value: '{{ $generalinfo->contact_no ?? '(02) 8123-7890 / 0917-987-6543' }}' },
                { label: 'SSS Employer Registration Number', value: '{{ $generalinfo->employer_sss_reg_no ?? 'SSS-987654321' }}' },
                { label: 'No. Of SSS Enrolled Employees', value: '{{ $generalinfo->sss_employees ?? '30' }}' },
                { label: 'Pag-IBIG Employer Registration Number', value: '{{ $generalinfo->employer_pagibig_reg_no ?? 'PAGIBIG-987654321' }}' },
                { label: 'No. Of Pagibig Enrolled Employees', value: '{{ $generalinfo->pagibig_employees ?? '25' }}' },
                { label: 'PhilHealth Employer Registration Number', value: '{{ $generalinfo->employer_philhealth_reg_no ?? 'PH-987654321' }}' },
                { label: 'No. Of PhilHealth Enrolled Employees', value: '{{ $generalinfo->philhealth_employees ?? '22' }}' },
                { label: 'BIR TIN Number', value: '{{ $generalinfo->bir_tin ?? '987-654-321-000' }}' },
                { label: 'BIR Tax Exemption Number', value: '{{ $generalinfo->bir_tax_exemption_no ?? 'BIR-EXEMPT-2025-002' }}' }
            ],
            membership: [
                { label: 'ENTRY YEAR', value: '{{ $membership->entry_year ?? '2025' }}' },
                { label: 'DRIVER', value: '{{ $membership->driver_male ?? '50' }}' },
                { label: 'OPERATOR/INVESTOR', value: '{{ $membership->operator_investor_male ?? '35' }}' },
                { label: 'ALLIED WORKERS', value: '{{ $membership->allied_workers_male ?? '15' }}' },
                { label: 'OTHER TYPE OF MEMBER', value: '{{ $membership->allied_workers_female ?? '10' }}' },
                { label: 'TOTAL MEMBERS', value: '{{ $membership->total_members ?? '110' }}' },
                { label: 'SPECIAL TYPE', value: '{{ $membership->number_of_senior ?? 'N/A' }}' }
            ],
            employment: {
            
                headers: ['PROBATIONARY (Male)', 'PROBATIONARY (Female)', 'REGULAR (Male)', 'REGULAR (Female)'],
                rows: [
                    {
                        category: 'EMPLOYEES (DRIVERS)',
                        values: ['{{ $employment->drivers_probationary_male ?? 'N/A' }}', '{{ $employment->drivers_probationary_female ?? 'N/A' }}', '{{ $employment->drivers_regular_male ?? 'N/A' }}', '{{ $employment->drivers_regular_female ?? 'N/A' }}']
                    },
                    {
                        category: 'MANAGEMENT STAFF',
                        values: ['{{ $employment->management_probationary_male ?? 'N/A' }}', '{{ $employment->management_probationary_female ?? 'N/A' }}', '{{ $employment->management_regular_male ?? 'N/A' }}', '{{ $employment->management_regular_female ?? 'N/A' }}']
                    },
                    {
                        category: 'EMPLOYEES (ALLIED WORKERS)',
                        values: ['{{ $employment->allied_probationary_male ?? 'N/A' }}', '{{ $employment->allied_probationary_female ?? 'N/A' }}', '{{ $employment->allied_regular_male ?? 'N/A' }}', '{{ $employment->allied_regular_female ?? 'N/A' }}']
                    }
                ]
            },
            units: {
                headers: ['MODE OF SERVICE', 'TYPE OF UNIT', 'No. of Cooperatively Owned Units ', 'No. of Individually Owned Units '],
                rows: [
                    {
                        mode: 'PUJ',
                        type: 'Modern',
                        values: ['{{ $unit->mode_of_service ?? 'N/A' }}', '{{ $unit->type_of_unit ?? 'N/A' }}', '{{ $unit->cooperatively_owned ?? 'N/A' }}', '{{ $unit->individually_owned ?? 'N/A' }}']
                    },

                ]
            },
            franchise: {
                headers: ['Route', 'CPC Case No.', 'Type of Franchise', 'Mode of Service', 'Type of Unit', 'Validity'],
                rows: [
                    {
                        year: '2021',
                        values: ['{{ $franchise->route ?? 'N/A' }}', '{{ $franchise->cpc_case_number ?? 'N/A' }}', '{{ $franchise->type_of_franchise ?? 'N/A' }}', '{{ $franchise->mode_of_service ?? 'N/A' }}', '{{ $franchise->type_of_unit ?? 'N/A' }}', '{{ $franchise->validity ?? 'N/A' }}']
                    },
                    {
                        year: '2022',
                        values: ['{{ $franchise->route ?? 'N/A' }}', '{{ $franchise->cpc_case_number ?? 'N/A' }}', '{{ $franchise->type_of_franchise ?? 'N/A' }}', '{{ $franchise->mode_of_service ?? 'N/A' }}', '{{ $franchise->type_of_unit ?? 'N/A' }}', '{{ $franchise->validity ?? 'N/A' }}']
                    }
                ]
            },
            governance: {
                headers: ['Role', 'First Name', 'Last Name', 'M.I.', 'Suffix', 'Term In Office', 'Mobile No.', 'E-mail'],
                rows: [
                    {
                        values: ['Chairperson', 'Carlos', 'Mendoza', 'A', '', '2023-2025', '0917-123-4567', 'carlos@email.com']
                    },
                    {
                        values: ['Vice-Chairperson', 'Liza', 'Garcia', 'B', '', '2023-2025', '0918-234-5678', 'liza@email.com']
                    },
                    {
                        values: ['Secretary', 'Rafael', 'Lopez', 'C', '', '2023-2025', '0919-345-6789', 'rafael@email.com']
                    }
                ]
            },
            finances: {
                headers: ['ENTRY YEAR', 'ASSETS', 'LIABILITIES', 'PAID-UP', 'AUTHORIZED', 'STATUTORY FUNDS', 'RESERVE FUND', 'EDUCATION FUND', 'OPT. FUND', 'CDF', 'INTEREST ON CAPITAL', 'PATRONAGE REFUND', 'DUE TO UNION/FEDERATION'],
                rows: [
                    {
                        values: ['2021', '7,000,000', '3,000,000', '4,000,000', '12,000,000', '600,000', '400,000', '200,000', '70,000', '150,000', '300,000', '250,000', '80,000']
                    },
                    {
                        values: ['2022', '9,000,000', '4,000,000', '5,000,000', '12,000,000', '800,000', '500,000', '300,000', '100,000', '200,000', '400,000', '300,000', '90,000']
                    },
                    {
                        values: ['2023', '10,500,000', '4,500,000', '6,000,000', '12,000,000', '1,000,000', '600,000', '350,000', '120,000', '250,000', '500,000', '400,000', '100,000']
                    }
                ]
            },
            grantsdonations: {
                headers: ['Date Acquired', 'Amount', 'Source', 'Status/Remarks'],
                rows: [
                    {
                        values: ['2021-06-15', '600,000', 'Department of Transportation', 'Fully utilized']
                    },
                    {
                        values: ['2022-09-10', '800,000', 'Local Government', 'Ongoing project']
                    },
                    {
                        values: ['2023-01-20', '400,000', 'Private Foundation', 'Completed']
                    }
                ]
            },
            loans: {
                headers: ['Financing Institution/s', 'Date Acquired', 'Amount of Loan', 'Utilization', 'Status/Remarks'],
                rows: [
                    {
                        values: ['Metro Bank', '2021-05-10', '3,000,000', 'Vehicle Acquisition', 'Fully paid']
                    },
                    {
                        values: ['Cooperative Bank', '2022-03-15', '2,000,000', 'Operational Expenses', 'Ongoing payment']
                    },
                    {
                        values: ['Government Program', '2023-02-28', '4,000,000', 'Modern Jeepney Purchase', 'Current']
                    }
                ]
            },
            businesses: {
                headers: ['Type', 'Nature of Business', 'Starting Capital', 'Capital to Date', 'Years of Existence', 'Status', 'Remarks'],
                rows: [
                    {
                        values: ['Retail', 'Fuel Station', '1,000,000', '1,500,000', '4', 'Operational', 'Steady growth']
                    },
                    {
                        values: ['Service', 'Vehicle Maintenance', '600,000', '900,000', '3', 'Operational', 'Profitable']
                    },
                    {
                        values: ['Transport', 'Shuttle Service', '1,200,000', '1,800,000', '2', 'Operational', 'Expanding']
                    }
                ]
            },
            trainingsseminars: {
                headers: ['Title of Training', 'Start Date', 'End Date', 'No. of Attendees', 'Remarks'],
                rows: [
                    {
                        values: ['Leadership Training', '2023-01-10', '2023-01-12', '40', 'Successful completion']
                    },
                    {
                        values: ['Safety Protocols', '2023-03-15', '2023-03-15', '30', 'Well-received']
                    },
                    {
                        values: ['Customer Service', '2023-05-20', '2023-05-22', '50', 'Mandatory for all staff']
                    }
                ]
            },
            scholarships: {
                headers: ['Course Taken', 'Scholarship Program','No. of TC Scholar Beneficiary', 'Remarks'],
                rows: [
                    {
                        values: ['NC II - Driving', 'TESDA Tsuper Iskolar', '10', 'Ongoing']
                    },
                ]
            },

            cetos: {
                headers: ['Members with CETOS (2020)', 'Members without CETOS (2020)', 'TOTAL (2020)', 'Members with CETOS (2021)', 'Members without CETOS (2021)', 'TOTAL (2021)', 'Members with CETOS (2022)', 'Members without CETOS (2022)', 'TOTAL (2022)'],
                rows: [
                    {
                        values: ['25', '35', '60', '30', '20', '50', '40', '10', '50']
                    }
                ]
            },
            awards: {
                headers: ['Awarding Body', 'Nature', 'Date Received', 'Remarks'],
                rows: [
                    {
                        values: ['City Government', 'Best Transport Cooperative', '2021-12-10', 'Annual Recognition']
                    },
                    {
                        values: ['Department of Transportation', 'Service Excellence', '2022-06-15', 'National Award']
                    },
                    {
                        values: ['Cooperative Development Authority', 'Most Innovative Cooperative', '2023-02-25', 'Regional Recognition']
                    }
                ]
            }
        },
        get filteredData() {
            if (!this.searchQuery) return [];

            let results = [];
            for (let category in this.cooperativeData) {
                if (Array.isArray(this.cooperativeData[category])) {
                    const items = this.cooperativeData[category].filter(item =>
                        item.value.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        item.label.toLowerCase().includes(this.searchQuery.toLowerCase())
                    ).map(item => ({
                        ...item,
                        category: category
                    }));
                    results.push(...items);
                }
            }
            return results;
        }
    }">

    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Transport Cooperative</h1>
        </div>

        <div class="flex justify-between mb-4">
            <button onclick="window.history.back()" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                ← Back
            </button>
            <a href="{{ route('edit.cooperative', ['accreditation_no' => $generalinfo->accreditation_no]) }}" class="text-blue-600 hover:underline">
                Edit
            </a>
        </div>

        <div class="flex gap-6">
            <!-- Include Navigation Menu -->
            @include('components.navigation-menu')

            <!-- Include Content Area -->
            <div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <!-- Section Title with Icon -->
                    <div class="flex items-center mb-6">
                        <span class="bg-blue-100 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                        <h2 class="text-xl font-semibold text-gray-800" x-text="tab === 'grantsdonations' ? 'Grants & Donations' : tab === 'trainingsseminars' ? 'Trainings & Seminars' : tab === 'cetos' ? 'CETOS' : tab.charAt(0).toUpperCase() + tab.slice(1)"></h2>
                    </div>
            
                    <!-- Simple Year Filter for Finance -->
                    <div x-show="tab === 'finance'" class="flex mb-6 bg-gray-50 p-3 rounded-lg items-center">
                        <span class="text-gray-600 mr-3 font-medium">View Year:</span>
                        <div class="flex space-x-2 flex-wrap">
                            <button class="px-3 py-1 rounded-full text-sm transition"
                                :class="selectedYear === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700'"
                                @click="selectedYear = 'all'">
                                All Years
                            </button>
                            <template x-for="year in availableYears" :key="year">
                                <button class="px-3 py-1 rounded-full text-sm transition"
                                    :class="selectedYear === year ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700'"
                                    @click="selectedYear = year"
                                    x-text="year">
                                </button>
                            </template>
                        </div>
                    </div>
            
                    <!-- Organized General Information with Categories -->
                    <template x-if="tab === 'general' && Array.isArray(cooperativeData[tab])">
                        <div class="space-y-8">
                            <!-- Cooperative Identity Section -->
                            <div class="flex-1 bg-">
                                <div class="p-6">
                                    <div class="flex items-center mb-6">
                                        <span class="bg-blue-100 p-2 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </span>
                                        <h2 class="text-xl font-semibold text-gray-800">Cooperative Identity</h2>
                                    </div>
            
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <template x-for="item in cooperativeData.general.filter(i =>
                                            ['Transport Cooperative Name', 'Short Name', 'Common Bond of Membership', 'Membership Fee (per by-laws)'].includes(i.label))" :key="item.label">
                                            <div class="p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                                <div class="text-sm text-gray-500 mb-1" x-text="item.label"></div>
                                                <div class="font-semibold text-lg text-gray-800" x-text="item.value"></div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Registration & Accreditation Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Registration & Accreditation
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-for="item in cooperativeData[tab].filter(i =>
                                        ['Accreditation Number', 'Type of Accreditation', 'Accreditation Date',
                                         'CDA Registration Number', 'CDA Registration Date'].includes(i.label))"
                                        :key="item.label">
                                        <div class="p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                            <div class="text-sm text-gray-500 mb-1" x-text="item.label"></div>
                                            <div class="font-semibold text-lg text-gray-800" x-text="item.value"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
            
                            <!-- Contact Information Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Contact Information
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-for="item in cooperativeData[tab].filter(i =>
                                        ['Area / Region / City / Province / Barangay', 'Business Address',
                                         'Contact Person', 'E-mail', 'Contact Number'].includes(i.label))"
                                        :key="item.label">
                                        <div class="p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                            <div class="text-sm text-gray-500 mb-1" x-text="item.label"></div>
                                            <div class="font-semibold text-lg text-gray-800" x-text="item.value"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
            
                            <!-- Government Registrations Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                    </svg>
                                    Government Registrations</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-for="item in cooperativeData[tab].filter(i =>
                                        ['SSS Employer Registration Number', 'No. Of SSS Enrolled Employees',
                                         'Pag-IBIG Employer Registration Number', 'No. Of Pagibig Enrolled Employees',
                                         'PhilHealth Employer Registration Number', 'No. Of PhilHealth Enrolled Employees',
                                         'BIR TIN Number', 'BIR Tax Exemption Number', 'BIR Tax Exemption Validity Date'].includes(i.label))"
                                        :key="item.label">
                                        <div class="p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                            <div class="text-sm text-gray-500 mb-1" x-text="item.label"></div>
                                            <div class="font-semibold text-lg text-gray-800" x-text="item.value"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
            
                            <!-- Assistance & Management Section -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Assistance & Management
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-for="item in cooperativeData[tab].filter(i =>
                                        ['Latest Date of Assess and Assist Activity',
                                         'Latest Date of Financial Management Assistance (FMA)'].includes(i.label))"
                                        :key="item.label">
                                        <div class="p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                            <div class="text-sm text-gray-500 mb-1" x-text="item.label"></div>
                                            <div class="font-semibold text-lg text-gray-800" x-text="item.value"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
            
                    <!-- Other Grid layouts for membership etc. -->
                    <template x-if="tab !== 'general' && Array.isArray(cooperativeData[tab])">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <template x-for="(item, index) in cooperativeData[tab]" :key="index">
                                <div class="p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                                    <div class="text-sm text-gray-500 mb-1" x-text="item.label"></div>
                                    <div class="font-semibold text-lg text-gray-800" x-text="item.value"></div>
                                </div>
                            </template>
                        </div>
                    </template>
            
                    <!-- Vertical table layout for other tabs - 2 columns on medium screens and up -->
                    <template x-if="cooperativeData[tab] && !Array.isArray(cooperativeData[tab])">
                        <div>
                            <!-- Section Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Filter the rows by year if in finance section -->
                                <template x-for="(row, rowIndex) in tab === 'finance' && selectedYear !== 'all' ? cooperativeData[tab].rows.filter(r => r.year === selectedYear) : cooperativeData[tab].rows" :key="rowIndex">
                                    <div class="rounded-lg border border-gray-200 overflow-hidden bg-white hover:shadow-md transition">
                                        <!-- Card Header -->
                                        <div class="bg-gray -50 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                                            <h3 class="font-medium text-gray-700" x-text="tab === 'units' ? row.mode + ' - ' + row.type :
                                                   tab === 'franchise' ? 'Year ' + row.year :
                                                   tab === 'employment' || tab === 'cetos' ? row.category :
                                                   'Record ' + (rowIndex + 1)"></h3>
            
                                            <!-- Simple Expand/Collapse -->
                                            <button @click="row.expanded = !row.expanded" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                <span x-show="!row.expanded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0 v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                </span>
                                                <span x-show="row.expanded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
            
                                        <!-- Card Content -->
                                        <div x-show="row.expanded" class="p-4">
                                            <dl class="divide-y divide-gray-200">
                                                <template x-for="(header, headerIndex) in cooperativeData[tab].headers" :key="headerIndex">
                                                    <div class="py-3 flex flex-col sm:flex-row">
                                                        <dt class="text-sm font-medium text-gray-500 sm:w-1/3 mb-1 sm:mb-0" x-text="header"></dt>
                                                        <dd class="text-sm font-semibold text-gray-900 sm:w-2/3 sm:pl-4" x-text="row.values[headerIndex]"></dd>
                                                    </div>
                                                </template>
                                            </dl>
                                        </div>
                                    </div>
                                </template>
                            </div>
            
                            <!-- No Results Message -->
                            <div x-show="tab === 'finance' && selectedYear !== 'all' && cooperativeData[tab].rows.filter(r => r.year === selectedYear).length === 0" class="text-center py-8 text-gray-500">
                                No data available for the selected year.
                                <button @click="selectedYear = 'all'" class="text-blue-600 hover:underline ml-2">View all years</button>
                            </div>
                        </div>
                    </template>
            
                    <!-- Proof Documents Section -->
                    <template x-if="!cooperativeData[tab]">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-8">
                            <!-- Letter of Request Card -->
                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Letter of Request
                                    </h3>
                                </div>
                                <div class="p-4">
                                    <img src="{{ asset('images/letter_request.jpg') }}" alt="Letter Request" class="w-full h-auto rounded shadow">
                                    <div class="mt-4 text-sm text-gray-600">
                                        Official letter of request for Certificate of Good Standing
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Proof of Compliance Card -->
                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Proof of Compliance
                                    </h3>
                                </div>
                                <div class="p-4">
                                    <img src="{{ asset('images/proof_of_compliance.jpg') }}" alt="Proof of Compliance" class="w-full h-auto rounded shadow">
                                    <div class="mt-4 text-sm text-gray-600">
                                        Documentation verifying compliance with regulatory requirements
                                    </div>
                                </div>
                            </div>
            
                             <!-- Proof of Compliance Card -->
                             <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg transition">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h3 class="font-medium text-gray-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Management Agreement
                                    </h3>
                                </div>
                                <div class="p-4">
                                    <object data="{{ asset('images/Requirements-Management-Agreement.pdf') }}" type="application/pdf" width="100%" height="500">
                                        <p>It seems your browser does not support embedded PDFs. You can <a href="{{ asset('images/Requirements-Management-Agreement.pdf') }}">download it here</a>.</p>
                                    </object>
                                    <div class="mt-4 text-sm text-gray-600">
                                        Documentation verifying compliance with regulatory requirements
                                    </div>
                                </div>
            
            
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cooperativeData', () => ({
                selectedYear: 'all',
                get availableYears() {
                    return this.cooperativeData.finance ?
                           [...new Set(this.cooperativeData.finance.rows.map(row => row.year))] :
                           [];
                },
                init() {
                    // Initialize expanded state for all rows
                    Object.keys(this.cooperativeData).forEach(key => {
                        if (this.cooperativeData[key] && !Array.isArray(this.cooperativeData[key]) && this.cooperativeData[key].rows) {
                            this.cooperativeData[key].rows.forEach(row => {
                                row.expanded = true; // Default expanded
                            });
                        }
                    });
                }
            }));
        });
        </script>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
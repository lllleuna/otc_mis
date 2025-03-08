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
                        values: ['20', '5', '45', '12']
                    },
                    {
                        category: 'MANAGEMENT STAFF',
                        values: ['4', '2', '10', '5']
                    },
                    {
                        category: 'EMPLOYEES (ALLIED WORKERS)',
                        values: ['6', '3', '15', '7']
                    },
                    {
                        category: 'TOTAL',
                        values: ['30', '10', '70', '24']
                    }
                ]
            },
            units: {
                headers: ['MODE OF SERVICE', 'TYPE OF UNIT', 'No. of Cooperatively Owned Units (2020)', 'No. of Individually Owned Units (2020)', 'No. of Cooperatively Owned Units (2021)', 'No. of Individually Owned Units (2021)', 'No. of Cooperatively Owned Units (2022)', 'No. of Individually Owned Units (2022)'],
                rows: [
                    {
                        mode: 'PUJ',
                        type: 'Modern',
                        values: ['12', '2', '18', '3', '25', '5']
                    },

                ]
            },
            franchise: {
                headers: ['CGS Number', 'CGS Date of Issuance', 'CGS Expiration Date'],
                rows: [
                    {
                        year: '2021',
                        values: ['CGS-2021-001', '2021-03-01', '2026-02-28']
                    },
                    {
                        year: '2022',
                        values: ['CGS-2022-002', '2022-04-15', '2027-04-14']
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
            @include('components.content-area')
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
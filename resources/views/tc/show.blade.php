<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Cooperative Details</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
                { label: 'OTC Accreditation Number', value: '{{ $cooperative->otc_number ?? 'OTC-2024-001' }}' },
                { label: 'Transport Cooperative Name', value: '{{ $cooperative->name ?? 'Sample Transport Cooperative' }}' },
                { label: 'Short Name', value: '{{ $cooperative->short_name ?? 'STC' }}' },
                { label: 'Type of Accreditation', value: '{{ $cooperative->accreditation_type ?? 'Full' }}' },
                { label: 'OTC Accreditation Date', value: '{{ $cooperative->otc_date ?? '2024-01-15' }}' },
                { label: 'Cooperative Registration Number', value: '{{ $cooperative->registration_number ?? 'REG-2024-001' }}' },
                { label: 'CDA Registration Date', value: '{{ $cooperative->cda_date ?? '2023-12-01' }}' },
                { label: 'Common Bond of Membership', value: '{{ $cooperative->bond ?? 'Transport Service Providers' }}' },
                { label: 'Membership Fee (per by-laws)', value: '{{ $cooperative->membership_fee ?? 'PHP 1,000.00' }}' },
                { label: 'Area / Region / City / Province / Barangay', value: '{{ $cooperative->area ?? 'NCR, Manila, Sampaloc' }}' },
                { label: 'Business Address', value: '{{ $cooperative->address ?? '123 Sample St, Sampaloc, Manila' }}' },
                { label: 'Contact Person', value: '{{ $cooperative->contact_person ?? 'Juan P. Dela Cruz Jr.' }}' },
                { label: 'E-mail', value: '{{ $cooperative->email ?? 'sample@email.com' }}' },
                { label: 'Contact Numbers', value: '{{ $cooperative->contact_numbers ?? '(02) 8123-4567 / 0917-123-4567' }}' },
                { label: 'SSS Employer Registration Number', value: '{{ $cooperative->sss_number ?? 'SSS-123456789' }}' },
                { label: 'No. Of SSS Enrolled Employees', value: '{{ $cooperative->sss_employees ?? '25' }}' },
                { label: 'Pag-IBIG Employer Registration Number', value: '{{ $cooperative->pagibig_number ?? 'PAGIBIG-123456789' }}' },
                { label: 'No. Of Pagibig Enrolled Employees', value: '{{ $cooperative->pagibig_employees ?? '22' }}' },
                { label: 'PhilHealth Employer Registration Number', value: '{{ $cooperative->philhealth_number ?? 'PH-123456789' }}' },
                { label: 'No. Of PhilHealth Enrolled Employees', value: '{{ $cooperative->philhealth_employees ?? '20' }}' },
                { label: 'BIR TIN Number', value: '{{ $cooperative->bir_tin ?? '123-456-789-000' }}' },
                { label: 'BIR Tax Exemption Number', value: '{{ $cooperative->bir_exemption ?? 'BIR-EXEMPT-2024-001' }}' },
                { label: 'BIR Tax Exemption Validity Date', value: '{{ $cooperative->bir_validity ?? '2026-01-15' }}' },
                { label: 'Latest Date of Assess and Assist Activity', value: '{{ $cooperative->assist_date ?? '2023-11-30' }}' },
                { label: 'Latest Date of Financial Management Assistance (FMA)', value: '{{ $cooperative->fma_date ?? '2023-10-15' }}' }
            ],
            membership: [
                { label: 'ENTRY YEAR', value: '{{ $cooperative->entry_year ?? '2023' }}' },
                { label: 'DRIVER', value: '{{ $cooperative->driver_members ?? '45' }}' },
                { label: 'OPERATOR/INVESTOR', value: '{{ $cooperative->operator_members ?? '30' }}' },
                { label: 'ALLIED WORKERS', value: '{{ $cooperative->allied_members ?? '20' }}' },
                { label: 'OTHER TYPE OF MEMBER', value: '{{ $cooperative->other_members ?? '5' }}' },
                { label: 'TOTAL MEMBERS', value: '{{ $cooperative->total_members ?? '100' }}' },
                { label: 'SPECIAL TYPE', value: '{{ $cooperative->special_type ?? 'N/A' }}' },
                { label: 'STATUS OF MEMBER', value: '{{ $cooperative->member_status ?? 'Active' }}' }
            ],
            employment: {
                headers: ['', 'PROBATIONARY (Male)', 'PROBATIONARY (Female)', 'REGULAR (Male)', 'REGULAR (Female)'],
                rows: [
                    {
                        category: 'EMPLOYEES (DRIVERS)',
                        values: ['15', '5', '40', '10']
                    },
                    {
                        category: 'MANAGEMENT STAFF',
                        values: ['3', '4', '8', '10']
                    },
                    {
                        category: 'EMPLOYEES (ALLIED WORKERS)',
                        values: ['5', '7', '12', '8']
                    },
                    {
                        category: 'TOTAL',
                        values: ['23', '16', '60', '28']
                    }
                ]
            },
            units: {
                headers: ['MODE OF SERVICE', 'TYPE OF UNIT', 'No. of Cooperatively Owned Units (2020)', 'No. of Individually Owned Units (2020)', 'No. of Cooperatively Owned Units (2021)', 'No. of Individually Owned Units (2021)', 'No. of Cooperatively Owned Units (2022)', 'No. of Individually Owned Units (2022)'],
                rows: [
                    {
                        mode: 'PUJ',
                        type: 'Modern',
                        values: ['10', '0', '15', '0', '20', '0']
                    },
                ]
            },
            franchise: {
                headers: ['CGS Number', 'CGS Date of Issuance', 'CGS Expiration Date'],
                rows: [
                    {
                        year: '2020',
                        values: ['CGS-2020-001', '2020-01-15', '2025-01-14']
                    },

                ]
            },
            governance: {
                headers: ['Role', 'First Name', 'Last Name', 'M.I.', 'Suffix', 'Term In Office', 'Mobile No.', 'E-mail'],
                rows: [
                    {
                        values: ['Chairperson', 'Juan', 'Dela Cruz', 'P', 'Jr.', '2022-2024', '0917-123-4567', 'juan@email.com']
                    },
                    {
                        values: ['Vice-Chairperson', 'Maria', 'Santos', 'L', '', '2022-2024', '0918-234-5678', 'maria@email.com']
                    },
                    {
                        values: ['Secretary', 'Pedro', 'Reyes', 'M', '', '2022-2024', '0919-345-6789', 'pedro@email.com']
                    }
                ]
            },
            finances: {
                headers: ['ENTRY YEAR', 'ASSETS', 'LIABILITIES', 'PAID-UP', 'AUTHORIZED', 'STATUTORY FUNDS', 'RESERVE FUND', 'EDUCATION FUND', 'OPT. FUND', 'CDF', 'INTEREST ON CAPITAL', 'PATRONAGE REFUND', 'DUE TO UNION/FEDERATION'],
                rows: [
                    {
                        values: ['2020', '5,000,000', '2,000,000', '3,000,000', '10,000,000', '500,000', '300,000', '150,000', '50,000', '100,000', '200,000', '150,000', '50,000']
                    },
                    {
                        values: ['2021', '6,500,000', '2,500,000', '4,000,000', '10,000,000', '650,000', '400,000', '200,000', '50,000', '120,000', '250,000', '180,000', '60,000']
                    },
                    {
                        values: ['2022', '8,000,000', '3,000,000', '5,000,000', '10,000,000', '800,000', '500,000', '250,000', '50,000', '150,000', '300,000', '200,000', '70,000']
                    }
                ]
            },
            grantsdonations: {
                headers: ['Date Acquired', 'Amount', 'Source', 'Status/Remarks'],
                rows: [
                    {
                        values: ['2020-05-15', '500,000', 'Department of Transportation', 'Fully utilized']
                    },
                    {
                        values: ['2021-08-22', '750,000', 'Local Government', 'Ongoing project']
                    },
                    {
                        values: ['2022-03-10', '300,000', 'Private Foundation', 'Completed']
                    }
                ]
            },
            loans: {
                headers: ['Financing Institution/s', 'Date Acquired', 'Amount of Loan', 'Utilization', 'Status/Remarks'],
                rows: [
                    {
                        values: ['Development Bank', '2020-06-10', '2,000,000', 'Vehicle Acquisition', 'Fully paid']
                    },
                    {
                        values: ['Cooperative Bank', '2021-04-15', '1,500,000', 'Operational Expenses', 'Ongoing payment']
                    },
                    {
                        values: ['Government Program', '2022-02-28', '3,000,000', 'Modern Jeepney Purchase', 'Current']
                    }
                ]
            },
            businesses: {
                headers: ['Type', 'Nature of Business', 'Starting Capital', 'Capital to Date', 'Years of Existence', 'Status', 'Remarks'],
                rows: [
                    {
                        values: ['Retail', 'Auto Parts Store', '500,000', '750,000', '3', 'Operational', 'Growing steadily']
                    },
                    {
                        values: ['Service', 'Vehicle Repair Shop', '800,000', '1,200,000', '2', 'Operational', 'Profitable']
                    },
                    {
                        values: ['Transport', 'Shuttle Service', '1,000,000', '1,500,000', '1', 'Operational', 'Expanding']
                    }
                ]
            },
            trainingsseminars: {
                headers: ['Title of Training', 'Start Date', 'End Date', 'No. of Attendees', 'Remarks'],
                rows: [
                    {
                        values: ['Cooperative Management', '2022-01-15', '2022-01-16', '30', 'Successful completion']
                    },
                    {
                        values: ['Financial Literacy', '2022-03-20', '2022-03-20', '25', 'Well-received']
                    },
                    {
                        values: ['Defensive Driving', '2022-05-10', '2022-05-12', '45', 'Mandatory for all drivers']
                    }
                ]
            },
            scholarships: {
                headers: ['Course Taken', 'No. of TC Scholar Beneficiary', 'Remarks'],
                rows: [
                    {
                        values: ['Business Administration', '5', 'Ongoing']
                    },
                    {
                        values: ['Automotive Technology', '8', 'Completed by 3']
                    },
                    {
                        values: ['Mechanical Engineering', '2', 'Ongoing']
                    }
                ]
            },
            cetos: {
                headers: ['', 'Members with CETOS (2020)', 'Members without CETOS (2020)', 'TOTAL (2020)', 'Members with CETOS (2021)', 'Members without CETOS (2021)', 'TOTAL (2021)', 'Members with CETOS (2022)', 'Members without CETOS (2022)', 'TOTAL (2022)'],
                rows: [
                    {
                        values: ['', '20', '30', '50', '35', '15', '50', '45', '5', '50']
                    }
                ]
            },
            awards: {
                headers: ['Awarding Body', 'Nature', 'Date Received', 'Remarks'],
                rows: [
                    {
                        values: ['City Government', 'Best Transport Cooperative', '2020-12-10', 'Annual Recognition']
                    },
                    {
                        values: ['Department of Transportation', 'Service Excellence', '2021-06-15', 'National Award']
                    },
                    {
                        values: ['Cooperative Development Authority', 'Most Improved Cooperative', '2022-02-25', 'Regional Recognition']
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
            <a href="{{ route('edit.cooperative') }}" class="text-blue-600 hover:underline">Edit</a>
        </div>

        <div class="flex gap-6">
            <!-- Include Navigation Menu -->
            @include('components.navigation-menu')

            <!-- Include Content Area -->
            @include('components.content-area')
        </div>
    </div>
</body>
</html>

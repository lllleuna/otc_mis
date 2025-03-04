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
                { label: 'OTC Accreditation Number', value: '{{ $cooperative->otc_number ?? 'OTC-2025-001' }}' },
                { label: 'Transport Cooperative Name', value: '{{ $cooperative->name ?? 'Metro Transport Cooperative' }}' },
                { label: 'Short Name', value: '{{ $cooperative->short_name ?? 'MTC' }}' },
                { label: 'Type of Accreditation', value: '{{ $cooperative->accreditation_type ?? 'Provisional' }}' },
                { label: 'OTC Accreditation Date', value: '{{ $cooperative->otc_date ?? '2025-02-01' }}' },
                { label: 'Cooperative Registration Number', value: '{{ $cooperative->registration_number ?? 'REG-2025-002' }}' },
                { label: 'CDA Registration Date', value: '{{ $cooperative->cda_date ?? '2024-12-15' }}' },
                { label: 'Common Bond of Membership', value: '{{ $cooperative->bond ?? 'Public Transport Operators' }}' },
                { label: 'Membership Fee (per by-laws)', value: '{{ $cooperative->membership_fee ?? 'PHP 1,500.00' }}' },
                { label: 'Area / Region / City / Province / Barangay', value: '{{ $cooperative->area ?? 'NCR, Quezon City, Barangay Central' }}' },
                { label: 'Business Address', value: '{{ $cooperative->address ?? '456 Metro Ave, Quezon City' }}' },
                { label: 'Contact Person', value: '{{ $cooperative->contact_person ?? 'Maria P. Santos' }}' },
                { label: 'E-mail', value: '{{ $cooperative->email ?? 'info@metrotransportcoop.com' }}' },
                { label: 'Contact Numbers', value: '{{ $cooperative->contact_numbers ?? '(02) 8123-7890 / 0917-987-6543' }}' },
                { label: 'SSS Employer Registration Number', value: '{{ $cooperative->sss_number ?? 'SSS-987654321' }}' },
                { label: 'No. Of SSS Enrolled Employees', value: '{{ $cooperative->sss_employees ?? '30' }}' },
                { label: 'Pag-IBIG Employer Registration Number', value: '{{ $cooperative->pagibig_number ?? 'PAGIBIG-987654321' }}' },
                { label: 'No. Of Pagibig Enrolled Employees', value: '{{ $cooperative->pagibig_employees ?? '25' }}' },
                { label: 'PhilHealth Employer Registration Number', value: '{{ $cooperative->philhealth_number ?? 'PH-987654321' }}' },
                { label: 'No. Of PhilHealth Enrolled Employees', value: '{{ $cooperative->philhealth_employees ?? '22' }}' },
                { label: 'BIR TIN Number', value: '{{ $cooperative->bir_tin ?? '987-654-321-000' }}' },
                { label: 'BIR Tax Exemption Number', value: '{{ $cooperative->bir_exemption ?? 'BIR-EXEMPT-2025-002' }}' },
                { label: 'BIR Tax Exemption Validity Date', value: '{{ $cooperative->bir_validity ?? '2027-02-01' }}' },
                { label: 'Latest Date of Assess and Assist Activity', value: '{{ $cooperative->assist_date ?? '2024-12-30' }}' },
                { label: 'Latest Date of Financial Management Assistance (FMA)', value: '{{ $cooperative->fma_date ?? '2024-11-15' }}' }
            ],
            membership: [
                { label: 'ENTRY YEAR', value: '{{ $cooperative->entry_year ?? '2025' }}' },
                { label: 'DRIVER', value: '{{ $cooperative->driver_members ?? '50' }}' },
                { label: 'OPERATOR/INVESTOR', value: '{{ $cooperative->operator_members ?? '35' }}' },
                { label: 'ALLIED WORKERS', value: '{{ $cooperative->allied_members ?? '15' }}' },
                { label: 'OTHER TYPE OF MEMBER', value: '{{ $cooperative->other_members ?? '10' }}' },
                { label: 'TOTAL MEMBERS', value: '{{ $cooperative->total_members ?? '110' }}' },
                { label: 'SPECIAL TYPE', value: '{{ $cooperative->special_type ?? 'N/A' }}' },
                { label: 'STATUS OF MEMBER', value: '{{ $cooperative->member_status ?? 'Active' }}' }
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

<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Application Details
    </h3>

    <div class="space-y-3">
        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Reference No</p>
                <p class="">{{ $application->reference_number }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Type of Application</p>
                <p class="">{{ strtoupper($application->application_type) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Date Submitted</p>
                <p class="">{{ $application->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Cooperative Name</p>
                <p class="">{{ $application->tc_name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ ucfirst($application->status) }}
                    </span>
                </p>
            </div>

        </div>

        <div class="pt-2">
            <p class="text-sm text-gray-500 mb-2">Attached Document</p>
            <a href="{{ asset('shared/uploads/' . basename($application->file_upload)) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition-colors"
                target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                </svg>
                View Document
            </a>
        </div>
    </div>
</div>

<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        General Information
    </h3>

    <div class="space-y-3">
        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">CDA Registration No</p>
                <p class="">{{ $appGenInfo->cda_registration_no ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">CDA REgistration Date</p>
                <p class="">{{ $appGenInfo->cda_registration_date ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Common Bond Membership</p>
                <p class="">{{ $appGenInfo->common_bond_membership ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Membership Fee</p>
                <p class="">{{ $appGenInfo->membership_fee ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Business Email</p>
                <p class="">{{ $appGenInfo->email ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Contact Number</p>
                <p class="">{{ $appGenInfo->contact_no ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Business Address</p>
                @php
                    $addressParts = [
                        $appGenInfo->business_address ?? 'N/A',
                        $appGenInfo->barangay ?? 'N/A',
                        $appGenInfo->province ?? 'N/A',
                        $appGenInfo->city ?? 'N/A',
                        $appGenInfo->region ?? 'N/A',
                        $appGenInfo->area ?? 'N/A',
                    ];
                    $address = implode(', ', array_filter($addressParts));
                @endphp

                <div class="flex">
                    <p>{{ $address }}</p>
                </div>

            </div>
        </div>

        <div class="flex justify-between pt-5">
            <div>
                <p class="text-sm text-gray-500">SSS Registration No</p>
                <p class="">{{ $appGenInfo->employer_sss_reg_no ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Pag-IBIG Registration No</p>
                <p class="">{{ $appGenInfo->employer_pagibig_reg_no ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">PhilHealth Registration No</p>
                <p class="">{{ $appGenInfo->employer_philhealth_reg_no ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">BIR Tax Identification No</p>
                <p class="">{{ $appGenInfo->bir_tin ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">BIR Tax Exemption No</p>
                <p class="">{{ $appGenInfo->bir_tax_exemption_no ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Date of Validity</p>
                <p class="">{{ $appGenInfo->validity ?? 'N/A' }}</p>
            </div>
        </div>

    </div>
</div>

<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Units
    </h3>

    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Type of Unit</th>
                <th class="px-4 py-2">Cooperatively Owned</th>
                <th class="px-4 py-2">Individually Owned</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appUnits as $appUnit)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $appUnit->type_of_unit ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appUnit->cooperatively_owned ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appUnit->individually_owned ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>

<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Franchise
    </h3>

    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Route</th>
                <th class="px-4 py-2">CPC Case No</th>
                <th class="px-4 py-2">Type of Unit</th>
                <th class="px-4 py-2">Validity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appFranchises as $franchise)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $franchise->route ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $franchise->cpc_case_number ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $franchise->type_of_unit ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $franchise->validity ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

{{-- Finance data are incomplete --}}
<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Finance
    </h3>

    <div class="space-y-3">
        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Current Assets</p>
                <p class="">{{ $appFinance->current_assets ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Non-Current Assets</p>
                <p class="">{{ $appFinance->noncurrent_assets ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total Assets</p>
                <p class="">{{ $appFinance->total_assets ?? 'N/A' }} ({{ $appFinance->coop_type ?? 'N/A' }})
                </p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Liabilities</p>
                <p class="">{{ $appFinance->liabilities ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Members Equity</p>
                <p class="">{{ $appFinance->members_equity ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total Gross Revenues</p>
                <p class="">{{ $appFinance->total_gross_revenues ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Expenses</p>
                <p class="">{{ $appFinance->total_expenses ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Net Surplus</p>
                <p class="">{{ $appFinance->net_surplus ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Initial Auth Capital Share</p>
                <p class="">{{ $appFinance->initial_auth_capital_share ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Capital Share</p>
                <p class="">{{ $appFinance->subscribed_capital_share ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Paid Up Capital</p>
                <p class="">{{ $appFinance->paid_up_capital ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Education/Training Fund</p>
                <p class="">{{ $appFinance->education_training_fund ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="flex justify-between">
            <div>
                <p class="text-sm text-gray-500">Share Capital Interest</p>
                <p class="">{{ $appFinance->share_capital_interest ?? 'N/A' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Patronage Refund</p>
                <p class="">{{ $appFinance->patronage_refund ?? 'N/A' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Deficit from Financial Aspect</p>
                <p class="">{{ $appFinance->deficit_from_financial_aspect ?? 'N/A' }}</p>
            </div>
        </div>

    </div>

</div>

<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Loans
    </h3>

    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Financing Institution</th>
                <th class="px-4 py-2">Date Acquired</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Utilization</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appLoans as $loan)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $loan->financing_institution ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $loan->acquired_at ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $loan->amount ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $loan->utilization ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Governance
    </h3>

    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Full Name</th>
                <th class="px-4 py-2">Term</th>
                <th class="px-4 py-2">Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appGov as $gov)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $gov->role_name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $gov->first_name ?? 'N/A' }} {{ $gov->middle_name ?? 'N/A' }}
                        {{ $gov->last_name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $gov->term_start ?? 'N/A' }} - {{ $gov->term_end ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $gov->mobile_number ?? 'N/A' }} <br> {{ $gov->email ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="mb-10">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Membership Details
    </h3>

    <div class="flex justify-between pt-5">

        <table class="w-full text-left border-collapse text-sm">
            <thead class="text-gray-400">
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Total Members</th>
                    <th class="px-4 py-2">SSS Enrolled</th>
                    <th class="px-4 py-2">Pag-IBIG Enrolled</th>
                    <th class="px-4 py-2">PhilHealth Enrolled</th>
                    <th class="px-4 py-2">With CETOS</th>
                    <th class="px-4 py-2">Without CETOS</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $appCetos->total ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appGenInfo->sss_enrolled ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appGenInfo->pagibig_enrolled ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appGenInfo->philhealth_enrolled ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appCetos->members_with ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $appCetos->members_without ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</div>

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

<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        General Information
    </h3>

    <div class="space-y-3">
        <!-- CDA Registration No -->
        <div class="flex justify-between">
            <div class="mx-1">
                <label class="text-sm text-gray-500">CDA Registration No</label>
                <input type="text" name="cda_registration_no"
                    value="{{ old('cda_registration_no', $application->cda_reg_no ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">CDA Registration Date</label>
                <input type="date" name="cda_registration_date"
                    value="{{ old('cda_registration_date', $application->cda_reg_date ?? '') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">Common Bond Membership</label>
                <input type="text" name="common_bond_membership"
                    value="{{ old('common_bond_membership', $appGenInfo->common_bond_membership ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>
        </div>

        <!-- Membership Fee, Email, Contact No -->
        <div class="flex justify-between">
            <div class="mx-1">
                <label class="text-sm text-gray-500">Membership Fee</label>
                <input type="number" step="0.01" name="membership_fee"
                    value="{{ old('membership_fee', $appGenInfo->membership_fee ?? '0.00') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">Business Email</label>
                <input type="email" name="email" value="{{ old('email', $appGenInfo->email ?? '') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">Contact Number</label>
                <input type="text" name="contact_no"
                    value="{{ old('contact_no', $appGenInfo->contact_no ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>
        </div>

        <!-- Business Address -->
        <div class="flex justify-between">
            <div class="w-full">
                @if ($application->application_type !== 'CGS Renewal')
                    <div class="w-1/2 mx-1">
                        <label class="text-sm text-gray-500">Business Address</label>
                        <input type="text" name="business_address"
                            value="{{ old('business_address', $application->address ?? 'N/A') }}"
                            class="border p-2 rounded w-full mt-1 mb-1">
                    </div>
                    <div class="w-1/2 mx-1">
                        <label class="text-sm text-gray-500">Barangay</label>
                        <input type="text" name="barangay" value="{{ old('barangay', $barangayName ?? 'N/A') }}"
                            placeholder="Barangay" class="border p-2 rounded w-full mt-1 mb-1" readonly>
                    </div>
                @endif
            </div>

            <div class="w-full">
                @if ($application->application_type !== 'CGS Renewal')
                    <div class="w-1/2 mx-1">
                        <label class="text-sm text-gray-500">Municipality/City</label>
                        <input type="text" name="city" value="{{ old('city', $cityName ?? 'N/A') }}"
                            placeholder="City" class="border p-2 rounded w-full mt-1 mb-1" readonly>
                    </div>
                    <div class="w-1/2 mx-1">
                        <label class="text-sm text-gray-500">Region</label>
                        <input type="text" name="region" value="{{ old('region', $regionName ?? 'N/A') }}"
                            placeholder="Region" class="border p-2 rounded w-full mt-1 mb-1" readonly>
                    </div>
                @endif
            </div>
        </div>



        <!-- SSS, Pag-IBIG, PhilHealth -->
        <div class="flex justify-between pt-5">
            <div class="mx-1">
                <label class="text-sm text-gray-500">SSS Registration No</label>
                <input type="text" name="employer_sss_reg_no"
                    value="{{ old('employer_sss_reg_no', $appGenInfo->employer_sss_reg_no ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">Pag-IBIG Registration No</label>
                <input type="text" name="employer_pagibig_reg_no"
                    value="{{ old('employer_pagibig_reg_no', $appGenInfo->employer_pagibig_reg_no ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">PhilHealth Registration No</label>
                <input type="text" name="employer_philhealth_reg_no"
                    value="{{ old('employer_philhealth_reg_no', $appGenInfo->employer_philhealth_reg_no ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>
        </div>

        <!-- BIR TIN, Tax Exemption, Validity -->
        <div class="flex justify-between">
            <div class="mx-1">
                <label class="text-sm text-gray-500">BIR Tax Identification No</label>
                <input type="text" name="bir_tin" value="{{ old('bir_tin', $appGenInfo->bir_tin ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">BIR Tax Exemption No</label>
                <input type="text" name="bir_tax_exemption_no"
                    value="{{ old('bir_tax_exemption_no', $appGenInfo->bir_tax_exemption_no ?? 'N/A') }}"
                    class="border p-2 rounded w-full">
            </div>

            <div class="mx-1">
                <label class="text-sm text-gray-500">Date of Validity</label>
                <input type="date" name="validity" value="{{ old('validity', $appGenInfo->validity ?? '') }}"
                    class="border p-2 rounded w-full">
            </div>
        </div>
    </div>
</div>


<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
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

<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
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



<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
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

<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Business
    </h3>
    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Nature of Business</th>
                <th class="px-4 py-2">Starting Capital</th>
                <th class="px-4 py-2">Capital to Date</th>
                <th class="px-4 py-2">Years of Existence</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appBusinesses as $business)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $business->type ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $business->nature_of_business ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $business->starting_capital ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $business->capital_to_date ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $business->years_of_existence ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Trainings/Seminar
    </h3>
    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Title of Training</th>
                <th class="px-4 py-2">No of Attendees</th>
                <th class="px-4 py-2">Total Fund</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appTrainings as $training)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $training->title_of_training ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $training->no_of_attendees ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $training->total_fund ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>



<div class="my-10">
    <h3 class=" mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
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

<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
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

<div class="my-10">
    <h3 class="mt-10 text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
        Awards
    </h3>
    <table class="w-full text-left border-collapse text-sm">
        <thead class="text-gray-400">
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Awarding Body</th>
                <th class="px-4 py-2">Nature of Award</th>
                <th class="px-4 py-2">Date Received</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appAwards as $award)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $award->awarding_body ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $award->nature_of_award ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $award->date_received ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

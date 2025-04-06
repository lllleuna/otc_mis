<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>
    <div class="max-w-5xl mx-auto p-8 bg-white rounded-2xl shadow-lg">

        {{-- Application Details --}}
        <h2 class="text-2xl font-bold text-blue-900 mb-6">Application Status History</h2>
        <button onclick="window.history.back()"
            class="px-4 py-2 font-bold text-sm bg-blue-900 text-white rounded-lg hover:bg-gray-300 transition">
            ← Back
        </button>

        {{-- Status Histories Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-200 p-3 text-left text-blue-900 font-semibold">Status</th>
                        <th class="border border-gray-200 p-3 text-left text-blue-900 font-semibold">Message</th>
                        <th class="border border-gray-200 p-3 text-left text-blue-900 font-semibold">Updated By</th>
                        <th class="border border-gray-200 p-3 text-left text-blue-900 font-semibold">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($application->statusHistories as $history)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-200 p-3 capitalize">{{ $history->status }}</td>
                            <td class="border border-gray-200 p-3">{{ $history->message ?? '-' }}</td>
                            <td class="border border-gray-200 p-3">{{ $history->updatedBy->employee_id_no ?? '-' }}</td>
                            <td class="border border-gray-200 p-3">{{ $history->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Divider --}}
        <hr class="my-8 border-gray-300">

        {{-- Uploaded Files --}}
        <h2 class="text-2xl font-bold text-blue-900 mb-6 mt-10">Uploaded Certificates</h2>

        @if ($application->maingeneralInfo)
            <div class="bg-gray-100 p-6 rounded-lg mb-6">
                <p class="mb-2 text-gray-700">Accreditation Number:
                    <span class="font-semibold text-blue-900">{{ $application->maingeneralInfo->accreditation_no }}</span>
                </p>
                <p class="mb-4 text-gray-700">Validity Date:
                    <span
                        class="font-semibold text-blue-900">{{ \Carbon\Carbon::parse($application->maingeneralInfo->validity_date)->format('F d, Y') }}</span>
                </p>

                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
                    {{-- Accreditation Certificate --}}
                    @if ($application->application_type !== 'CGS Renewal')
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800 mb-2">Accreditation Certificate:</h4>
                            @if ($application->maingeneralInfo->accreditation_certificate_filename)
                                <a href="{{ asset('shared/certificates/' . $application->maingeneralInfo->accreditation_certificate_filename) }}"
                                    target="_blank"
                                    class="inline-block bg-blue-900 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-800 transition">
                                    View Certificate
                                </a>
                            @else
                                <p class="text-gray-600">No Certificate Uploaded</p>
                            @endif
                        </div>
                    @endif

                    {{-- CGS Certificate --}}
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-800 mb-2">Certificate of Good Standing:</h4>
                        @if ($application->maingeneralInfo->cgs_filename)
                            <a href="{{ asset('shared/certificates/' . $application->maingeneralInfo->cgs_filename) }}"
                                target="_blank"
                                class="inline-block bg-blue-900 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-800 transition">
                                View CGS
                            </a>
                        @else
                            <p class="text-gray-600">No CGS Uploaded</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <p class="text-gray-700">No General Information Available.</p>
        @endif

    </div>
</x-layout>

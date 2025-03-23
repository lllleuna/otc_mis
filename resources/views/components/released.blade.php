@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow">

    {{-- Application Details --}}
    <h2 class="text-xl font-bold mb-4">Application Status History</h2>

    {{-- Status Histories --}}
    <table class="min-w-full border">
        <thead>
            <tr>
                <th class="border p-2">Status</th>
                <th class="border p-2">Message</th>
                <th class="border p-2">Updated By</th>
                <th class="border p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($application->statusHistories as $history)
                <tr>
                    <td class="border p-2 capitalize">{{ $history->status }}</td>
                    <td class="border p-2">{{ $history->message ?? '-' }}</td>
                    <td>{{ $history->updatedBy->employee_id_no ?? '-' }}</td>
                    <td class="border p-2">{{ $history->created_at->format('M d, Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Divider --}}
    <hr class="my-6">

    {{-- Uploaded Files --}}
    <h2 class="text-xl font-bold mb-4">Uploaded Certificates</h2>

    @if($application->maingeneralInfo)
        <p class="mb-2">Accreditation Number: <strong>{{ $application->maingeneralInfo->accreditation_no }}</strong></p>
        <p class="mb-4">Validity Date: <strong>{{ \Carbon\Carbon::parse($application->maingeneralInfo->validity_date)->format('F d, Y') }}</strong></p>

        <div class="flex space-x-6">
            <div>
                <h4 class="font-medium">Accreditation Certificate:</h4>
                @if ($application->maingeneralInfo->accreditation_certificate_filename)
                    <a href="{{ asset('storage/certificates/' . $application->maingeneralInfo->accreditation_certificate_filename) }}" target="_blank" class="text-blue-500 underline">View Certificate</a>
                @else
                    <p>No Certificate Uploaded</p>
                @endif
            </div>

            <div>
                <h4 class="font-medium">CGS Certificate:</h4>
                @if ($application->maingeneralInfo->cgs_filename)
                    <a href="{{ asset('storage/certificates/' . $application->maingeneralInfo->cgs_filename) }}" target="_blank" class="text-blue-500 underline">View CGS</a>
                @else
                    <p>No CGS Uploaded</p>
                @endif
            </div>
        </div>
    @else
        <p>No General Information Available.</p>
    @endif

</div>
@endsection

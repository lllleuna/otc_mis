<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css'])
        <title>Approval</title>
    </head>
</head>

<body>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Application Approval</h2>

        {{-- Application Information --}}
        <div class="mb-4 p-4 border rounded-md bg-gray-50">
            <h3 class="text-lg font-semibold mb-2">Cooperative Details</h3>
            <p><strong>Reference No:</strong> {{ $application->reference_number }}</p>
            <p><strong>TC Name:</strong> {{ $application->tc_name }}</p>
            <p><strong>File Upload:</strong>
                <a href="{{ asset('storage/' . $application->file_upload) }}" target="_blank"
                    class="text-blue-600 hover:underline">
                    View File
                </a>
            </p>
        </div>

        {{-- Evaluator Details --}}
        <div class="mb-4 p-4 border rounded-md bg-gray-50">
            <h3 class="text-lg font-semibold mb-2">Evaluation Details</h3>
            @if ($evaluation)
                <p><strong>Evaluator:</strong> {{ optional($evaluation->updatedBy)->firstname ?? '' }}
                    {{ optional($evaluation->updatedBy)->lastname ?? '' }}</p>
                <p><strong>Employee ID:</strong> {{ optional($evaluation->updatedBy)->employee_id_no ?? 'Unknown' }}</p>
                <p><strong>Date of Evaluation:</strong> {{ $evaluation->updated_at->format('F d, Y H:i A') }}</p>
                <p><strong>Message:</strong> {{ $evaluation->message }}</p>
            @else
                <p class="text-gray-500">No evaluation records found.</p>
            @endif
        </div>

        {{-- Approval Form --}}
        <form action="{{ route('accreditation.storeApproval', $application->id) }}" method="POST">
            @csrf

            {{-- Message Box --}}
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="w-full p-2 border rounded-md" required></textarea>
            </div>

            {{-- Status Selection --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Approval Status</label>
                <select name="status" id="status" class="w-full p-2 border rounded-md" required>
                    <option value="approved">Approve</option>
                    <option value="rejected">Reject</option>
                    <option value="needs_info">Needs More Info</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Submit Approval
            </button>
        </form>
    </div>
</body>

</html>

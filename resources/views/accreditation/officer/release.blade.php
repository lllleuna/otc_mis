<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css'])
        <title>Releasing</title>
    </head>
</head>

<body>

    <div class="max-w-7xl mx-auto p-4">
        <button onclick="window.history.back()"
            class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            ← Back
        </button>
    </div>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Releasing of Certificate</h2>

        {{-- Application Information --}}
        <div class="mb-4 p-4 border rounded-md bg-gray-50 max-h-64 overflow-y-auto">
            @include('components.releasing')
        </div>


        {{-- Evaluator Details --}}
        <div class="mb-4 p-4 border rounded-md bg-gray-50">
            <h3 class="text-lg font-semibold mb-2">Approval Details</h3>
            @if ($evaluation)
                <p><strong>Approved by:</strong> {{ optional($evaluation->updatedBy)->firstname ?? '' }}
                    {{ optional($evaluation->updatedBy)->lastname ?? '' }}</p>
                <p><strong>Employee ID:</strong> {{ optional($evaluation->updatedBy)->employee_id_no ?? 'Unknown' }}</p>
                <p><strong>Date of Approval:</strong> {{ $evaluation->updated_at->format('F d, Y H:i A') }}</p>
                <p><strong>Message:</strong> {{ $evaluation->message }}</p>
            @else
                <p class="text-gray-500">No evaluation records found.</p>
            @endif
        </div>

        {{-- Releasing Form --}}
        <form action="{{ route('accreditation.storeRelease', $application->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            {{-- Validity Date --}}
            @php
                $nineMonthsLater = \Carbon\Carbon::now()->addMonths(9)->format('Y-m-d');
            @endphp

            <div class="mb-4">
                <label for="validity_date" class="block text-sm font-medium text-gray-700">CGS Validity Date</label>
                <input type="date" name="validity_date" id="validity_date" value="{{ $nineMonthsLater }}"
                    min="{{ $nineMonthsLater }}" {{-- Minimum date set to 9 months ahead --}} class="w-full p-2 border rounded-md" required>
            </div>


            {{-- File Upload --}}
            @if ($application->application_type !== 'CGS Renewal')
                <div class="mb-4">
                    <label for="certificate_file" class="block text-sm font-medium text-gray-700">Upload Accreditation
                        Certificate</label>
                    <input type="file" name="certificate_file" id="certificate_file"
                        class="w-full p-2 border rounded-md" accept=".pdf,.jpg,.jpeg,.png" required>

                    @error('certificate_file')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <div class="mb-4">
                <label for="cgs_file" class="block text-sm font-medium text-gray-700">Upload Certificate of Good
                    Standing</label>
                <input type="file" name="cgs_file" id="cgs_file" class="w-full p-2 border rounded-md"
                    accept=".pdf,.jpg,.jpeg,.png" required>

                @error('cgs_file')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Message Box --}}
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="w-full p-2 border rounded-md" required></textarea>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Release Certificate
            </button>
        </form>

    </div>
</body>

</html>

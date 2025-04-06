<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Approval</x-slot:title>


    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="w-full bg-blue-900 py-2 px-5 flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-white">Application</h2>
            <button onclick="window.history.back()"
                class="px-4 py-2 font-bold text-sm bg-white text-black rounded-lg hover:bg-gray-400 transition">
                ← Back
            </button>
        </div>

        {{-- Application Information --}}
        <div class="mb-4 p-4 border rounded-md bg-gray-50 max-h-64 overflow-y-auto">
            @include('components.releasing')
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
                </select>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800">
                Submit Approval
            </button>
        </form>
    </div>
</x-layout>

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
            <h3 class="text-lg font-semibold mb-2">Authentication Details</h3>
            @if ($evaluation)
                <p><strong>OD Officer Name:</strong> {{ optional($evaluation->updatedBy)->firstname ?? '' }}
                    {{ optional($evaluation->updatedBy)->lastname ?? '' }}</p>
                <p><strong>Employee ID:</strong> {{ optional($evaluation->updatedBy)->employee_id_no ?? 'Unknown' }}</p>
                <p><strong>Date of Authentication:</strong> {{ $evaluation->updated_at->format('F d, Y H:i A') }}</p>
                <p><strong>Message:</strong> {{ $evaluation->message }}</p>
            @else
                <p class="text-gray-500">No records found.</p>
            @endif
        </div>

        @if ($application->additional_file)
            <div class="mb-4 p-4 border rounded-md bg-gray-50">
                <h3 class="text-lg font-semibold mb-2">Additional File</h3>
                <div>
                    <!-- Link or Display the additional file -->
                    <a href="{{ asset($application->additional_file) }}" target="_blank" class="text-blue-600">View Document</a>
                </div>
            </div>
        @endif


        {{-- Approval Form --}}
        <form action="{{ route('accreditation.storeApproval', $application->id) }}" method="POST">
            @csrf

            {{-- Message Box --}}
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message for Transportation
                    Cooperative</label>
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

    <button id="backToTopBtn"
        class="hidden fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full shadow-lg transition-opacity duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M3.293 9.707a1 1 0 011.414 0L10 5.414l5.293 4.293a1 1 0 111.414-1.414l-6-5a1 1 0 00-1.414 0l-6 5a1 1 0 010 1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <script>
        const backToTopBtn = document.getElementById("backToTopBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 200) {
                backToTopBtn.classList.remove("hidden");
            } else {
                backToTopBtn.classList.add("hidden");
            }
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>


</x-layout>

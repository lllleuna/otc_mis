<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Authentication</x-slot:title>


    <div class="w-4/5 m-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-900 px-6 py-4 flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-white">Authentication</h2>
            <button onclick="window.history.back()"
                class="px-4 py-2 font-bold text-sm bg-white text-black rounded-lg hover:bg-gray-400 transition">
                ← Back
            </button>
        </div>

        <form method="POST" action="{{ route('accreditation.storeEvaluation', $application->id) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="md:flex ">
                <!-- Application Details (Left Panel) -->
                <div class="md:w-2/3 p-6 bg-gray-50 md:overflow-y-auto md:max-h-[calc(100vh-12rem)]">
                    @include('components.evaluationInfo')
                </div>

                <!-- Evaluation Form (Right Panel) -->
                <div class="md:w-1/3 p-6 bg-white">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                        Authentication Form
                    </h3>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Checklist of Requirements</label>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <input type="checkbox" name="requirements[letter_request]" value="1"
                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    @checked($application->has_letter_request == 1)>
                                <span class="ml-3 text-sm text-gray-700">Letter Request signed by the Cooperative’s
                                    Chairperson</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" name="requirements[cda_cert]" value="1"
                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    @checked($application->has_cda_cert == 1)>
                                <span class="ml-3 text-sm text-gray-700">Photocopy of Certificate of Registration issued
                                    by the CDA</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" name="requirements[orcr_15_units]" value="1"
                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    @checked($application->has_orcr_15_units == 1)>
                                <span class="ml-3 text-sm text-gray-700">At least 15 units of OR/CR together with the
                                    copy of Decision/Order of CPC</span>
                            </li>
                            <li class="flex items-start">
                                <input type="checkbox" name="requirements[bank_cert]" value="1"
                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    @checked($application->has_bank_cert == 1)>
                                <span class="ml-3 text-sm text-gray-700">Bank Certificate of Deposit representing the
                                    paid-up capital of the cooperative</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-6">
                        <label for="additional_file" class="block text-sm font-medium text-gray-700 mb-1">
                            Upload Additional File
                        </label>
                        <input type="file" name="additional_file" id="additional_file"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">

                        @if ($application->additional_file)
                            <div class="mt-2">
                                <span class="text-sm text-gray-700">Uploaded File: </span>
                                <a href="{{ asset('/' . $application->additional_file) }}" class="text-blue-600"
                                    target="_blank">{{ basename($application->additional_file) }}</a>
                            </div>
                        @else
                            <div class="mt-2">
                                <span class="text-sm text-gray-700">No file uploaded</span>
                            </div>
                        @endif

                        @error('additional_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="space-y-6">
                        <div>
                            <label for="evaluation_notes" class="block text-sm font-medium text-gray-700 mb-1">
                                Authentication Notes <span class="text-red-500">*</span>
                            </label>
                            <textarea id="evaluation_notes" name="evaluation_notes"
                                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                rows="4" placeholder="Enter your evaluation notes here..." required>
                            {{ old('evaluation_notes', $latestEvaluation->message ?? '') }}
                        </textarea>
                            @error('evaluation_notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-4 pt-4">
                            <!-- Save Draft Button -->
                            <button type="submit" name="action" value="save"
                                class="inline-flex items-center px-4 py-2 border border-yellow-300 text-sm font-medium rounded-md text-yellow-700 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Save Draft
                            </button>

                            <!-- Send Email Button -->
                            <button type="submit" name="action" value="send_email"
                                class="inline-flex items-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
                                title="Clicking this button will send an email to the transport cooperative requesting additional information or documents.">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12H8m8 0l-4 4m4-4l-4-4m-6 8a9 9 0 1118 0 9 9 0 01-18 0z" />
                                </svg>
                                Send Email
                            </button>

                            <!-- Submit Evaluation Button -->
                            <button type="submit" name="action" value="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Submit
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trim whitespace from textarea on form submission
            document.querySelector('form').addEventListener('submit', function(e) {
                const evaluationNotes = document.getElementById('evaluation_notes');
                evaluationNotes.value = evaluationNotes.value.trim();

                if (!evaluationNotes.value) {
                    e.preventDefault();
                    alert('Please enter evaluation notes before proceeding.');
                    evaluationNotes.focus();
                }
            });
        });
    </script>
</x-layout>

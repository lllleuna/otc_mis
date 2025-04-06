<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Evaluation</x-slot:title>


    <div class="w-4/5 m-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-blue-900">Evaluate Application</h2>
            <button onclick="window.history.back()"
                class="px-4 py-2 font-bold text-sm bg-blue-900 text-white rounded-lg hover:bg-blue-700 transition">
                ← Back
            </button>
        </div>

        <form method="POST" action="{{ route('accreditation.storeEvaluation', $application->id) }}">
            @csrf
            
            <div class="md:flex ">
                <!-- Application Details (Left Panel) -->
                <div class="md:w-2/3 p-6 bg-gray-50 md:overflow-y-auto md:max-h-[calc(100vh-12rem)]">
                    @include('components.evaluationInfo')
                </div>

                <!-- Evaluation Form (Right Panel) -->
                <div class="md:w-1/3 p-6 bg-white">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                        Evaluation Form
                    </h3>
                    <div class="space-y-6">
                        <div>
                            <label for="evaluation_notes" class="block text-sm font-medium text-gray-700 mb-1">
                                Evaluation Notes <span class="text-red-500">*</span>
                            </label>
                            <textarea id="evaluation_notes" name="evaluation_notes"
                                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                rows="8" placeholder="Enter your evaluation notes here..." required>
                            {{ old('evaluation_notes', $latestEvaluation->message ?? '') }}
                        </textarea>
                            @error('evaluation_notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-4 pt-4">
                            <button type="submit" name="action" value="save"
                                class="inline-flex items-center px-4 py-2 border border-yellow-300 text-sm font-medium rounded-md text-yellow-700 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Save Draft
                            </button>
                            <button type="submit" name="action" value="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Submit Evaluation
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
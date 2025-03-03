<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Evaluation</title>
</head>

<body>

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Evaluate Application</h2>
        </div>

        <div class="md:flex">
            <!-- Application Details (Left Panel) -->
            <div class="md:w-1/2 p-6 bg-gray-50 md:overflow-y-auto md:max-h-[calc(100vh-12rem)]">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Application Details
                </h3>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Reference No</p>
                        <p class="font-medium">{{ $application->reference_number }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Cooperative Name</p>
                        <p class="font-medium">{{ $application->tc_name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Region</p>
                        <p class="font-medium">{{ $application->region }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-medium">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($application->status) }}
                            </span>
                        </p>
                    </div>

                    <div class="pt-2">
                        <p class="text-sm text-gray-500 mb-2">Attached Document</p>
                        <a href="{{ asset('/storage/' . $application->file_upload) }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition-colors"
                            target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                            </svg>
                            View Document
                        </a>
                    </div>
                </div>
            </div>

            <!-- Evaluation Form (Right Panel) -->
            <div class="md:w-1/2 p-6 bg-white">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Evaluation Form
                </h3>

                <form method="POST" action="{{ route('accreditation.storeEvaluation', $application->id) }}"
                    class="space-y-6">
                    @csrf
                    <div>
                        <label for="evaluation_notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Evaluation Notes
                        </label>
                        <textarea id="evaluation_notes" name="evaluation_notes"
                            class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                            rows="8" placeholder="Enter your evaluation notes here...">
                            {{ old('evaluation_notes', $latestEvaluation->message ?? '') }}
                        </textarea>

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
                </form>
            </div>
        </div>
    </div>


</body>

</html>

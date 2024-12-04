<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Application Details</x-slot:title>

    <x-container>
        <div class="flex">
            {{-- Evaluation Form --}}
            <div class="bg-white rounded-lg shadow-xl p-8 w-1/3">
                <!-- Form Title -->
                <h2 class="text-xl font-semibold mb-4">Evaluation Form</h2>
                    
                <!-- Check if applicable -->
                <form action="/application/{{ $application->id }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Check the following if applicable:</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox h-3 w-3 text-blue-600" />
                                <span class="ml-2 text-gray-800">CDA Registered</span>
                            </label>
                        </div>
                    </div>
                        
                        <!-- Units Section -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Units:</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="units" value="15_units" class="form-radio h-3 w-3 text-blue-600" />
                                <span class="ml-2 text-gray-800">At least 15 units of OR/CR</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="units" value="lacking_units" class="form-radio h-3 w-3 text-blue-600" />
                                <span class="ml-2 text-gray-800">Lacking the required minimum number of units</span>
                            </label>
                        </div>
                    </div>
                        
                        <!-- Remarks Section -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Remarks:</label>
                        <textarea name="eval_remarks"
                            class="w-full mt-2 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                            rows="4" 
                            placeholder="Add any remarks or observations here..." required></textarea>
                    </div>
    
                        <!-- Document Verification -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">I hereby certify that:</label>
                        <div class="mt-2 space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox h-3 w-3 text-blue-600" required/>
                                <span class="ml-2 text-gray-800">The submitted documents are original or certified true copies.</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox h-3 w-3 text-blue-600" required/>
                                <span class="ml-2 text-gray-800">The provided information meets the required standards and aligns with the supporting documents.</span>
                            </label>
                        </div>
                    </div>

                    <input type="text" hidden name="application_id" id="" value="{{ $application->id }}">
                        
                        <!-- Submit Button -->
                    <div class="mt-4">
                        <button 
                            type="submit" 
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Submit for Review and Approval
                        </button>
                    </div>
                </form>
                  
            </div>
        
            {{-- Application Requirements/Information Submitted --}}
            <div class="bg-white rounded-lg shadow-xl p-8 ml-4 w-2/3">
                <h4 class="text-xl text-gray-900 font-bold">Accreditation</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex border-y py-2">
                        <span class="font-bold w-24">Full name:</span>
                        <span class="text-gray-700">{{ $application->tc_name}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </x-container>

</x-layout>
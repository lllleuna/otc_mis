<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">General Information Details</h2>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <table class="w-full border-collapse">
                <tbody>
                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider w-1/3">
                            Cooperative Status</th>
                        <td class="px-6 py-4">
                            @php
                                $latestYear = $relatedInfos->max('created_at')
                                    ? date('Y', strtotime($relatedInfos->max('created_at')))
                                    : null;
                                $currentYear = date('Y');
                                $isActive = $latestYear == $currentYear;
                            @endphp
                            <div class="flex items-center">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <span
                                        class="h-2 w-2 mr-2 rounded-full {{ $isActive ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    {{ $isActive ? 'Active' : 'Not Active' }}
                                </span>
                            </div>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider w-1/3">
                            Accreditation No</th>
                        <td class="px-6 py-4 text-gray-800">{{ $info->accreditation_no }}</td>
                    </tr>
                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Accreditation Date</th>
                        <td class="px-6 py-4 text-gray-800">{{ date('M d, Y', strtotime($info->accreditation_date)) }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Region</th>
                        <td class="px-6 py-4 text-gray-800">{{ $info->region }}</td>
                    </tr>
                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            City</th>
                        <td class="px-6 py-4 text-gray-800">{{ $info->city }}</td>
                    </tr>
                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Barangay</th>
                        <td class="px-6 py-4 text-gray-800">{{ $info->barangay }}</td>
                    </tr>
                    <tr class="border-b">
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Email</th>
                        <td class="px-6 py-4 text-gray-800">{{ $info->email }}</td>
                    </tr>
                    <tr>
                        <th
                            class="bg-gray-50 px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            Contact No</th>
                        <td class="px-6 py-4 text-gray-800">{{ $info->contact_no }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-4">CGS Renewal History</h3>
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 p-6">
            @foreach ($relatedInfos as $relatedInfo)
                <div class="py-2 border-b border-gray-200 last:border-0">
                    <p class="text-gray-700">{{ date('M d, Y', strtotime($relatedInfo->created_at)) }}</p>
                </div>
            @endforeach
        </div>

        <a href="{{ route('general-info.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>

</x-layout>

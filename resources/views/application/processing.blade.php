<x-application-layout>

    <div class="my-6 m-auto w-4/5 items-center whitespace-nowrap relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Transport Cooperative Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CDA Registration No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Processing Since
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reviewed By
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Evaluated By
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($applications as $application)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="px-6 py-4 ">
                        {{ $application->tc_name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application->cda_reg_no ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application->status ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application->processing_since ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application->reviewer_name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application->evaluator_account ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="/application/{{ $application->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Verify</a>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td colspan="7" class="px-6 py-4 text-center">
                        No applications found.
                    </td>
                </tr>
                @endforelse

                <!-- Sample Data -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 ">
                        Sample Transport Cooperative
                    </td>
                    <td class="px-6 py-4">
                        CDA654321
                    </td>
                    <td class="px-6 py-4">
                        Processing
                    </td>
                    <td class="px-6 py-4">
                        2023-10-01
                    </td>
                    <td class="px-6 py-4">
                        JaneDoe
                    </td>
                    <td class="px-6 py-4">
                        JohnDoe123
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="/application/2" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Verify</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</x-application-layout>

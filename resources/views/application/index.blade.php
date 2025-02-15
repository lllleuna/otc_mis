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
                        CDA Registration Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Application Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($applications as $application)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td  class="px-6 py-4 ">
                        {{ $application['tc_name'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application['cda_reg_no'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application['cda_reg_date'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $application['created_at'] }}
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="/application/{{ $application->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Evaluate</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</x-application-layout>

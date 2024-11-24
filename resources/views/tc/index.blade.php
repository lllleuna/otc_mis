<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Transport Cooperative</x-slot:title>

    <x-container>
        <div class="flex">

            <div class="text-gray-600 bg-white text-sm rounded-lg shadow-xl p-2 py-8 w-1/5">
                <form action="/search" method="GET">
                    <x-form-label for="search">Search</x-form-label>
                    <input id="search" name="search" type="text" placeholder="Search ..." class="w-full p-1 rounded-md mb-3 border-2 ">
                    <x-form-label for="sort">Sort By</x-form-label>
                    <select name="sort" id="sort" class="w-full p-1 rounded-md mb-3 border-2 ">
                        <option value="">Date (asc)</option>
                        <option value="">Date (desc)</option>
                        <option value="">Name (A-Z)</option>
                        <option value="">Name (Z-A)</option>
                    </select>
                    <x-form-label for="date_from">Date Range</x-form-label>
                    <input id="date_from" name="date_from" type="date" placeholder="" class="w-full p-1 rounded-md mb-3 border-2 ">
                    <input id="date_from" name="date_from" type="date" placeholder="" class="w-full p-1 rounded-md mb-3 border-2 ">
                    
                    <x-form-label for="">List</x-form-label>
                    <div class="flex items-center mb-2">
                        <input id="list-1" type="radio" value="" name="list" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="list-1" class="ms-2">Membership</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input id="list-2" type="radio" value="" name="list" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="list-2" class="ms-2">Employment</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input id="list-3" type="radio" value="" name="list" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="list-3" class="ms-2">Units</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input id="list-4" type="radio" value="" name="list" class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="list-4" class="ms-2">Franchise</label>
                    </div>

                    <button type="submit" class="w-full p-1 mt-5 text-white rounded-md mb-3 bg-blue-900">Search</button>
                </form>
            </div>


            <div class="whitespace-nowrap ml-2 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Accreditation No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Transport Cooperative Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date of Accreditation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type of Accreditation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date of Accreditation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type of Accreditation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date of Accreditation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type of Accreditation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($coops as $coop)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            
                            <td  class="px-6 py-4 ">
                                {{ $coop['accreditation_no'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['name'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['accreditation_date'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['accreditation_type'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['accreditation_date'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['accreditation_date'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['accreditation_type'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $coop['accreditation_type'] }}
                            </td>
                            <td class="px-6 py-4 flex">
                                <a href="/tc/{{ $coop->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                <a href="/tc/{{ $coop->id }}" class="ml-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

        </div>
    </x-container>

</x-layout>
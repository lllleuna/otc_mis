<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Transport Cooperative</x-slot:title>

    <x-container>
        <div class="flex gap-4">
            <!-- Sidebar Filter - Keep the same but improve styling -->
            <div class="w-72 bg-white rounded-lg shadow-lg p-6">
                <form action="/search" method="GET">
                    <x-form-label for="search">Search</x-form-label>
                    <input id="search" name="search" type="text" placeholder="Search ..."
                        class="w-full p-2 rounded-md mb-4 border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                    <x-form-label for="sort">Sort By</x-form-label>
                    <select name="sort" id="sort"
                        class="w-full p-2 rounded-md mb-4 border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <option value="">Date (asc)</option>
                        <option value="">Date (desc)</option>
                        <option value="">Name (A-Z)</option>
                        <option value="">Name (Z-A)</option>
                    </select>

                    <x-form-label for="date_from">Date Range</x-form-label>
                    <div class="space-y-2 mb-4">
                        <input id="date_from" name="date_from" type="date"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <input id="date_to" name="date_to" type="date"
                            class="w-full p-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <x-form-label>List Type</x-form-label>
                    <div class="space-y-2 mb-4">
                        <label class="flex items-center p-2 rounded hover:bg-gray-50">
                            <input type="radio" name="list" value="membership" class="mr-2">
                            <span>Membership</span>
                        </label>
                        <label class="flex items-center p-2 rounded hover:bg-gray-50">
                            <input type="radio" name="list" value="employment" class="mr-2">
                            <span>Employment</span>
                        </label>
                        <label class="flex items-center p-2 rounded hover:bg-gray-50">
                            <input type="radio" name="list" value="units" class="mr-2">
                            <span>Units</span>
                        </label>
                        <label class="flex items-center p-2 rounded hover:bg-gray-50">
                            <input type="radio" name="list" value="franchise" class="mr-2">
                            <span>Franchise</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-200">
                        Search
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="mb-4 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Transport Cooperatives</h2>
                        <div class="space-x-2">
                            <button class="px-4 py-2 text-sm bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100">
                                Export
                            </button>
                            <button class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Add New
                            </button>
                        </div>
                    </div>

                    <div class="border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Accreditation No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Transport Cooperative Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>

                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($coops as $coop)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $coop['accreditation_no'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $coop['name'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $coop['accreditation_date'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $coop['accreditation_type'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/tc/show" class="text-blue-600 hover:text-blue-900 mr-3">View</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-layout>

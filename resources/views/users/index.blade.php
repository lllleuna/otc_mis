<x-layout>
    <x-slot:vite>@vite('resources/js/modal.js')</x-slot:vite>
    <x-slot:title>Users</x-slot:title>

    <div class="mx-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                <select class="block p-2 mx-5 text-sm text-gray-900 border border-gray-300 rounded-lg w-40 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    <option>All</option>
                    <option>Approver</option>
                    <option>Encoder</option>
                    <option>Viewer</option>
                </select>
            </div>

            <div class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <form action="/search" method="GET">
                        <input type="text" name="search" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for user">
                        <button type="submit" class="hidden">Search</button>
                    </form>
                </div>
                <x-button onclick="openModal('modalCreate')">Create</x-button>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Employee ID</th>
                    <th scope="col" class="px-6 py-3">Division</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a class="font-medium text-gray-700">{{ $user['firstname'] . " " . $user['lastname'] }}</a><br>
                        <a class="">{{ $user['email'] }}</a>
                    </td>
                    <td class="px-6 py-4">{{ $user['employee_id_no'] }}</td>
                    <td class="px-6 py-4">{{ $user['division'] }}</td>
                    <td class="px-6 py-4">{{ $user['role'] }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center">
                            <span class="h-2.5 w-2.5 rounded-full {{ $user['is_online'] ? 'bg-green-500' : 'bg-gray-500' }} me-2"></span>
                            {{ $user['is_online'] ? 'Online' : 'Offline' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="/users/{{ $user->id }}" class="font-medium text-blue-600 hover:underline">See more</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <x-modal id="modalCreate" class="{{ $errors->any() ? 'modal-error' : 'hidden' }}">
        <x-slot:closebtnSlot>
            <x-modal-close-button onclick="closeModal('modalCreate')" />
        </x-slot:closebtnSlot>
        @include('users.create')

    </x-modal>

</x-layout>
@include('components.footer')

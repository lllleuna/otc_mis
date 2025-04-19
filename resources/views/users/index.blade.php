<x-layout>
    <x-slot:vite>@vite('resources/js/modal.js')</x-slot:vite>
    <x-slot:title>Users</x-slot:title>

    <div class="mx-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                {{-- Division Dropdown --}}
                <select id="divisionFilter"
                    class="block p-2 text-sm px-5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Divisions</option>
                    <option value="OD">OD</option>
                    <option value="PED">PED</option>
                    <option value="AFD">AFD</option>
                    <option value="OED">OED</option>
                </select>

                <select id="role_filter"
                    class="block p-2 text-sm px-5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Divisions</option>
                    <option value="Admin">Admin</option>
                    <option value="Officer 1">Officer 1</option>
                    <option value="Officer 2">Officer 2</option>
                </select>

                {{-- Search Bar --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <form action="/search" method="GET">
                        <input type="text" name="search" id="table-search"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for user">
                        <button type="submit" class="hidden">Search</button>
                    </form>
                </div>

                <x-button onclick="openModal('modalCreate')">Create</x-button>
            </div>

        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Employee ID</th>
                    <th scope="col" class="px-6 py-3">Division</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50" data-division="{{ $user['division'] }}">
                        <td class="px-6 py-4">
                            <a
                                class="font-medium text-gray-700">{{ $user['firstname'] . ' ' . $user['lastname'] }}</a><br>
                            <a class="">{{ $user['email'] }}</a>
                        </td>
                        <td class="px-6 py-4">{{ $user['employee_id_no'] }}</td>
                        <td class="px-6 py-4">{{ $user['division'] }}</td>
                        <td class="px-6 py-4">{{ $user['role'] }}</td>
                        <td class="px-6 py-4">
                            <a href="/users/{{ $user->id }}" class="font-medium text-blue-600 hover:underline">See
                                more</a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td colspan="5" class="text-center py-8 text-gray-500">No records found.</td>
                    </tr>
                @endforelse
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

    <script>
        document.getElementById('divisionFilter').addEventListener('change', function() {
            const selectedDivision = this.value;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const division = row.getAttribute('data-division');
                if (!selectedDivision || division === selectedDivision) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>


</x-layout>
@include('components.footer')

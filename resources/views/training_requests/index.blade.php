<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Training Requests</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Training Requests</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('training.index') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search by CDA Reg. No or Reference
                    No</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="training_type" class="block text-sm font-medium text-gray-700">Search by Training
                    Type</label>
                <select name="training_type" id="training_type"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="face-to-face" {{ request('training_type') == 'face-to-face' ? 'selected' : '' }}>
                        Face-to-Face</option>
                    <option value="online" {{ request('training_type') == 'online' ? 'selected' : '' }}>Online</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Search</button>
            </div>
        </form>


        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ref No.</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">CDA Reg. No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Training Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Submitted At</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($requests as $req)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $req->reference_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $req->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $req->cda_reg_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $req->training_type ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ ucfirst($req->status) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $req->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('training.show', $req->id) }}"
                                    class="inline-block bg-blue-500 text-blue-800 text-xs px-3 py-1 rounded hover:bg-blue-600 transition">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No training requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $requests->withQueryString()->links() }}
        </div>
    </div>
</x-layout>

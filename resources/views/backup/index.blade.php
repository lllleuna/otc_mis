<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Backup System</title>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
        <h2 class="text-xl font-semibold mb-4">Database Backup</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Backup Button --}}
        <button onclick="document.getElementById('backupModal').classList.remove('hidden')"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Create Backup
        </button>

        {{-- Backup History --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Backup History</h3>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-2 border">File Name</th>
                        <th class="p-2 border">Type</th>
                        <th class="p-2 border">Created By</th>
                        <th class="p-2 border">Date</th>
                        <th class="p-2 border">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($backups as $backup)
                        <tr class="text-center">
                            <td class="p-2 border">{{ $backup->file_name }}</td>
                            <td class="p-2 border">{{ $backup->file_type }}</td>
                            <td class="p-2 border">{{ optional($backup->user)->firstname ?? 'Unknown' }}</td>
                            <td class="p-2 border">{{ $backup->created_at->format('F d, Y H:i A') }}</td>
                            <td class="p-2 border">
                                <a href="{{ route('backup.download', $backup->file_name) }}" class="text-blue-600 hover:underline">
                                    Download
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Password Confirmation Modal --}}
    <div id="backupModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-lg">
            <h3 class="text-lg font-semibold mb-2">Confirm Backup</h3>
            <form action="{{ route('backup.create') }}" method="POST">
                @csrf
                <label class="block mb-2">Enter Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded-md mb-4" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Confirm
                </button>
                <button type="button" onclick="document.getElementById('backupModal').classList.add('hidden')"
                    class="ml-2 text-gray-600 hover:underline">
                    Cancel
                </button>
            </form>
        </div>
    </div>
</body>

</html>

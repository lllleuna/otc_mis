<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>

    <div class="container">
        <h2 class="mb-4">General Information Details</h2>
        <table class="table table-bordered">
            <tr>
                <th>Accreditation No</th>
                <td>{{ $info->accreditation_no }}</td>
            </tr>
            <tr>
                <th>Accreditation Date</th>
                <td>{{ $info->accreditation_date }}</td>
            </tr>
            <tr>
                <th>Region</th>
                <td>{{ $info->region }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $info->city }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $info->barangay }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $info->email }}</td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td>{{ $info->contact_no }}</td>
            </tr>
        </table>

        <h3>CGS Renewal History</h3>
        @foreach ($relatedInfos as $relatedInfo)
            <p>{{ $relatedInfo->created_at }}</p>
        @endforeach
        <a href="{{ route('general-info.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

</x-layout>

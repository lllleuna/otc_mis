<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>

    <div class="container">
        <h2 class="mb-4">General Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Accreditation No</th>
                    <th>Accreditation Date</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($generalInfos as $info)
                    <tr>
                        <td>{{ $info->accreditation_no ?? 'No Accreditation No' }}</td>
                        <td>{{ $info->accreditation_date }}</td>
                        <td>{{ $info->region }}</td>
                        <td>{{ $info->city }}</td>
                        <td>{{ $info->email }}</td>
                        <td>{{ $info->contact_no }}</td>
                        <td>
                            <a href="{{ route('general-info.show', ['accreditation_no' => $info->accreditation_no]) }}"
                                class="btn btn-primary btn-sm">
                                View
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout>

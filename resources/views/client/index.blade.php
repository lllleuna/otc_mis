<x-layout>
    <x-slot:vite>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot:vite>

    <x-slot:title>Client Details</x-slot:title>

    <div class="container mt-4">
        <h2 class="mb-4">General Information</h2>

        <!-- Search & Filter Controls -->
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Accreditation No, City, or Email">
            </div>
            <div class="col-md-4">
                <select id="regionFilter" class="form-control">
                    <option value="">Filter by Region</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region['code'] }}">{{ $region['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
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
            <tbody id="infoTable">
                @forelse ($generalInfos as $info)
                    <tr>
                        <td>{{ $info->accreditation_no ?? 'No Accreditation No' }}</td>
                        <td>{{ $info->accreditation_date }}</td>
                        <td>{{ $info->region_name }}</td>
                        <td>{{ $info->city_name }}</td>
                        <td>{{ $info->email }}</td>
                        <td>{{ $info->contact_no }}</td>
                        <td>
                            <a href="{{ route('general-info.show', ['accreditation_no' => $info->accreditation_no]) }}" class="btn btn-primary btn-sm">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const regionFilter = document.getElementById("regionFilter");
            const tableRows = document.querySelectorAll("#infoTable tr");

            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                const selectedRegion = regionFilter.value;

                tableRows.forEach(row => {
                    const accreditationNo = row.cells[0].textContent.toLowerCase();
                    const city = row.cells[3].textContent.toLowerCase();
                    const email = row.cells[4].textContent.toLowerCase();
                    const regionCode = row.cells[2].getAttribute("data-region");

                    const matchesSearch = accreditationNo.includes(searchText) || city.includes(searchText) || email.includes(searchText);
                    const matchesRegion = selectedRegion === "" || regionCode === selectedRegion;

                    row.style.display = matchesSearch && matchesRegion ? "" : "none";
                });
            }

            searchInput.addEventListener("input", filterTable);
            regionFilter.addEventListener("change", filterTable);
        });
    </script>

</x-layout>

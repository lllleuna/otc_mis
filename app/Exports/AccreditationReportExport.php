<?php

namespace App\Exports;

use App\Models\GeneralInfo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Import WithHeadings concern

class AccreditationReportExport implements FromCollection, WithHeadings
{
    protected $cooperatives;

    // Accept the filtered cooperatives as a parameter
    public function __construct(Collection $cooperatives)
    {
        $this->cooperatives = $cooperatives;
    }

    public function collection()
    {
        // Return the filtered cooperatives data
        return $this->cooperatives;
    }

    /**
     * Define the column headers for the export
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'CDA Registration No',   // Header for the first column
            'Accreditation No',      // Header for the second column
            'Name',                  // Header for the third column
            'Region',                // Header for the fourth column
            'City',                  // Header for the fifth column
            'Status',                // Header for the sixth column
            'Accreditation Date',    // Header for the seventh column
        ];
    }
}

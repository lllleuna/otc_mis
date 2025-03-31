<?php

namespace App\Exports;

use App\Models\GeneralInfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Import WithHeadings concern

class AccreditationReportExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch the data you want to export
        return GeneralInfo::selectRaw("
                cda_registration_no, 
                accreditation_no, 
                name, 
                region, 
                city, 
                status, 
                accreditation_date
            ")
            ->whereNotNull('accreditation_no')
            ->get();
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

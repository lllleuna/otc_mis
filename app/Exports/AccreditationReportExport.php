<?php

namespace App\Exports;

use App\Models\GeneralInfo;
use Maatwebsite\Excel\Concerns\FromCollection;

class AccreditationReportExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Assuming you're using the same query as the controller
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
}

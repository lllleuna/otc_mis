<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CGSRenewalReportExport implements FromCollection, WithHeadings
{
    protected $cooperatives;

    public function __construct(Collection $cooperatives)
    {
        $this->cooperatives = $cooperatives;
    }

    public function collection()
    {
        return $this->cooperatives;
    }

    public function headings(): array
    {
        return [
            'CDA Registration No',
            'Validity Date',
            'Accreditation No',
            'Region',
        ];
    }
}

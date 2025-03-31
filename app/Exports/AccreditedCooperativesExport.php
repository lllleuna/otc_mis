<?php

namespace App\Exports;

use App\Models\GeneralInfo;
use Maatwebsite\Excel\Concerns\FromCollection;

class AccreditedCooperativesExport implements FromCollection
{
    protected $cooperatives;

    public function __construct($cooperatives)
    {
        $this->cooperatives = $cooperatives;
    }

    public function collection()
    {
        return $this->cooperatives;
    }
}

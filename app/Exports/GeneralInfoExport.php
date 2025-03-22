<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;


class GeneralInfoExport implements FromCollection, WithHeadings
{
    protected $generalInfos;

    public function __construct($generalInfos)
    {
        $this->generalInfos = $generalInfos;
    }

    public function collection()
    {
        // Map region codes to names
        $regions = [
            '010000000' => 'Region I (Ilocos Region)',
            '020000000' => 'Region II (Cagayan Valley)',
            '030000000' => 'Region III (Central Luzon)',
            '040000000' => 'Region IV-A (CALABARZON)',
            '170000000' => 'MIMAROPA Region',
            '050000000' => 'Region V (Bicol Region)',
            '060000000' => 'Region VI (Western Visayas)',
            '070000000' => 'Region VII (Central Visayas)',
            '080000000' => 'Region VIII (Eastern Visayas)',
            '090000000' => 'Region IX (Zamboanga Peninsula)',
            '100000000' => 'Region X (Northern Mindanao)',
            '110000000' => 'Region XI (Davao Region)',
            '120000000' => 'Region XII (SOCCSKSARGEN)',
            '130000000' => 'Region XIII (Caraga)',
            'CAR' => 'Cordillera Administrative Region',
            'NCR' => 'National Capital Region',
            'BARMM' => 'Bangsamoro Autonomous Region in Muslim Mindanao',
        ];

        return $this->generalInfos->map(function($info) use ($regions) {
            return [
                'Cooperative Name' => $info->name ?? 'N/A',
                'Registration No.' => $info->cda_registration_no ?? 'N/A',
                'Region' => $regions[$info->region] ?? 'Unknown Region',
                'Status' => ucfirst($info->status) ?? 'N/A',
                'Validity Date' => $info->validity_date ? \Carbon\Carbon::parse($info->validity_date)->format('M d, Y') : 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cooperative Name',
            'Registration No.',
            'Region',
            'Status',
            'Validity Date',
        ];
    }
}

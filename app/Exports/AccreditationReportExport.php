<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AccreditationReportExport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $cooperatives;
    protected $user;

    public function __construct(Collection $cooperatives, $user)
    {
        $this->cooperatives = $cooperatives;
        $this->user = $user;
    }

    public function collection()
    {
        return $this->cooperatives;
    }

    public function headings(): array
    {
        return [
            'CDA Registration No',
            'Accreditation No',
            'Name',
            'Region',
            'City',
            'Status',
            'Accreditation Date',
        ];
    }

    public function title(): string
    {
        return 'Accreditation Report';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Insert 5 rows before the heading row
                $sheet->insertNewRowBefore(1, 5);

                // Title
                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', 'Accreditation Report');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Generated on
                $sheet->mergeCells('A2:G2');
                $sheet->setCellValue('A2', 'Generated on: ' . now()->format('F j, Y'));
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'size' => 10],
                ]);

                // Generated by
                $sheet->mergeCells('A3:G3');
                $sheet->setCellValue('A3', 'Generated by: ' . $this->user->employee_id_no . ' - ' . $this->user->firstname . ' ' . $this->user->lastname);
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => ['italic' => true, 'size' => 10],
                ]);

                $sheet->mergeCells('A4:G4');
                $sheet->setCellValue('A4', 'Division: ' . $this->user->division . ' | Role: ' . $this->user->role . ' | Email: ' . $this->user->email);
                $sheet->getStyle('A4')->applyFromArray([
                    'font' => ['italic' => true, 'size' => 10],
                ]);

                // Style header row (now on row 6)
                $sheet->getStyle('A6:G6')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'f2f2f2'],
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Optional: Adjust column widths
                foreach (range('A', 'G') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}

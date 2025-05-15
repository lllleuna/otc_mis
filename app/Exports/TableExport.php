<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TableExport implements FromCollection, WithHeadings
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function collection()
    {
        return collect(DB::table($this->table)->get()); // Fetch table data
    }

    public function headings(): array
    {
        return array_keys((array) DB::table($this->table)->first() ?? []);
    }
}

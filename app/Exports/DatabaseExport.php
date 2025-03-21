<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\DB;

class DatabaseExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $tables = DB::select('SHOW TABLES'); // Get all table names
        $sheets = [];

        foreach ($tables as $table) {
            $tableName = reset($table); // Extract the table name
            $sheets[] = new TableExport($tableName); // Add a sheet for each table
        }

        return $sheets;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BackupHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatabaseExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class BackupController extends Controller
{
    public function index()
    {
        $backups = BackupHistory::latest()->get();
        return view('backup.index', compact('backups'));
    }

    public function createBackup(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $sqlFileName = "backup_" . now()->format('Y-m-d_H-i-s') . ".sql";
        $sqlPath = storage_path("app/backups/{$sqlFileName}");

        $tables = DB::select('SHOW TABLES');
        $output = "-- Laravel DB Backup\n-- Generated: " . now() . "\n\n";

        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map(fn($table) => reset($table), $tables);

        usort($tableNames, function ($a, $b) {
            $aForeignKeyCount = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_NAME', $a)
                ->whereNotNull('REFERENCED_TABLE_NAME')
                ->count();

            $bForeignKeyCount = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_NAME', $b)
                ->whereNotNull('REFERENCED_TABLE_NAME')
                ->count();

            return $aForeignKeyCount <=> $bForeignKeyCount;
        });

        $output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $tableName = reset($table);
            
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $createTableSql = $createTable[0]->{'Create Table'} ?? '';
            $output .= "DROP TABLE IF EXISTS `{$tableName}`;\n{$createTableSql};\n\n";
            
            $tableData = DB::table($tableName)->get();
            if (count($tableData) > 0) {
                $insertHeaders = "INSERT INTO `{$tableName}` VALUES\n";
                $insertValues = [];
                
                foreach ($tableData as $row) {
                    $rowValues = [];
                    foreach ((array)$row as $value) {
                        if (is_null($value)) {
                            $rowValues[] = "NULL";
                        } else {
                            $rowValues[] = "'" . addslashes($value) . "'";
                        }
                    }
                    $insertValues[] = "(" . implode(",", $rowValues) . ")";
                }
                
                $output .= $insertHeaders . implode(",\n", $insertValues) . ";\n\n";
            }
        }

        $output .= "SET FOREIGN_KEY_CHECKS=1;\n";

        file_put_contents($sqlPath, $output);

        // Save SQL backup history
        BackupHistory::create([
            'file_name' => $sqlFileName,
            'file_type' => 'SQL',
            'created_by' => $user->id,
        ]);

        $timestamp = now()->format('Y-m-d_H-i-s');

        // Create Excel Backup (not yet working)
        $xlsxFileName = "backup_{$timestamp}.xlsx";
        $xlsxPath = "backups/{$xlsxFileName}";

        Excel::store(new DatabaseExport, $xlsxPath, 'local'); // Save to storage/app/backups

        // Save Excel backup history (not yet woring)
        BackupHistory::create([
            'file_name' => $xlsxFileName,
            'file_type' => 'XLSX',
            'created_by' => $user->id,
        ]);

        return back()->with('success', 'Backup created successfully!');
    }


    public function downloadBackup($fileName)
    {
        $filePath = storage_path("app/backups/{$fileName}");

        if (!file_exists($filePath)) {
            return back()->withErrors(['file' => 'File not found.']);
        }

        return response()->download($filePath);
    }
}

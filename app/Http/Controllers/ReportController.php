<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use App\Models\ReportHistory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exports\GeneralInfoExport;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch report history, latest first, WITH pagination, WITHOUT admin relation
        $reportHistories = ReportHistory::orderBy('generated_at', 'desc')->paginate(10);
    
        return view('tc.generate-reports', compact('reportHistories'));
    }
    
    public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|string',
            'year' => 'nullable|string',
            'region' => 'nullable|string',
            'format' => 'required|in:pdf,excel',
        ]);
    
        $timestamp = Carbon::now()->format('Ymd_His');
        $fileName = $validated['report_type'] . '_' . ($validated['year'] ?? 'All') . '_' . $timestamp;
    
        // Base query for Active status
        $query = GeneralInfo::where('status', 'Active');
    
        // Apply filters
        if (!empty($validated['region'])) {
            $query->where('region', $validated['region']);
        }
    
        if (!empty($validated['year'])) {
            $query->whereYear('created_at', $validated['year']);
        }
    
        // Use a subquery to ensure only one row per cda_registration_date (latest entry)
        $query->whereIn('id', function ($subquery) {
            $subquery->selectRaw('id FROM (
                SELECT id, ROW_NUMBER() OVER (PARTITION BY cda_registration_date ORDER BY created_at DESC) as row_num
                FROM general_info
                WHERE status = "Active"
            ) as temp WHERE row_num = 1');
        });
    
        $generalInfos = $query->get();
    
        $data = [
            'report_type' => ucfirst($validated['report_type']),
            'year' => $validated['year'],
            'region' => $validated['region'],
            'generated_at' => Carbon::now()->toDateTimeString(),
            'generalInfos' => $generalInfos,
        ];
    
        // Ensure the shared reports directory exists
        if (!file_exists(public_path('shared/reports'))) {
            mkdir(public_path('shared/reports'), 0777, true);
        }
    
        if ($validated['format'] === 'pdf') {
            $pdf = PDF::loadView('reports.accredited-report', $data);
            $pdfPath = public_path("shared/reports/{$fileName}.pdf");
            $pdf->save($pdfPath);
        } else {
            // Store Excel file in shared storage
            Excel::store(
                new GeneralInfoExport($generalInfos),
                "reports/{$fileName}.xlsx",
                'shared'
            );
    
            // Move file manually to shared directory if needed
            $excelFullPath = storage_path("app/reports/{$fileName}.xlsx");
            if (file_exists($excelFullPath)) {
                rename($excelFullPath, public_path("shared/reports/{$fileName}.xlsx"));
            }
        }
    
        // Save report generation history
        ReportHistory::create([
            'report_type' => $validated['report_type'],
            'year' => $validated['year'],
            'region' => $validated['region'],
            'format' => $validated['format'],
            'file_name' => $fileName . '.' . ($validated['format'] === 'pdf' ? 'pdf' : 'xlsx'),
            'admin_id' => auth()->id(),
            'generated_at' => now(),
        ]);
    
        return back()->with('success', 'Report generated successfully!');
    }
    
    


    public function download($id)
    {
        $history = ReportHistory::findOrFail($id);
    
        // Adjust path to shared storage
        $filePath = public_path('shared/reports/' . $history->file_name);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File not found.');
        }
    }    
    
}

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
        
        // Fetch report history, latest first, with pagination (optional)
        $reportHistories = ReportHistory::with('admin') // Assuming admin relation is set
            ->orderBy('generated_at', 'desc')
            ->paginate(10);

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
    
        $query = GeneralInfo::query();
    
        if ($validated['region']) {
            $query->where('region', $validated['region']);
        }
    
        if ($validated['year']) {
            $query->whereYear('created_at', $validated['year']); // Adjust column name if needed
        }
    
        $generalInfos = $query->get();
    
        $data = [
            'report_type' => ucfirst($validated['report_type']),
            'year' => $validated['year'],
            'region' => $validated['region'],
            'generated_at' => Carbon::now()->toDateTimeString(),
            'generalInfos' => $generalInfos,
        ];
    
        // Ensure directory exists
        if (!file_exists(public_path('storage/reports'))) {
            mkdir(public_path('storage/reports'), 0777, true);
        }
    
        if ($validated['format'] === 'pdf') {
            $pdf = PDF::loadView('reports.accredited-report', $data);
            $pdfPath = "storage/reports/{$fileName}.pdf";
            $pdf->save(public_path($pdfPath));
        } else {
            $excelPath = "storage/reports/{$fileName}.xlsx";
            Excel::store(new GeneralInfoExport($generalInfos), "reports/{$fileName}.xlsx", 'public');
        }
    
        // Save history record
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

        $filePath = public_path('storage/reports/' . $history->file_name);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File not found.');
        }
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\ReportHistory;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exports\GeneralInfoExport;
use App\Exports\AccreditedCooperativesExport;


class GenerateReportController extends Controller
{
    // Main page for selecting the report type and filters
    public function index()
    {
        return view('reports.index');
    }

    // Generate the selected report (PDF or Excel)
    public function generateReport(Request $request)
    {
        $reportType = $request->input('report_type');
        $region = $request->input('region');
        $format = $request->input('format');

        // Query the cooperatives based on filters
        $query = GeneralInfo::query();

        if ($region) {
            $query->where('region', $region);
        }

        switch ($reportType) {
            case 'all_accredited':
                // No additional filtering needed
                break;
            case 'newly_accredited':
                $query->whereYear('accreditation_date', now()->year);
                break;
            case 'active':
                $query->where('status', 'Active');
                break;
            case 'inactive':
                $query->where('status', 'Inactive');
                break;
        }

        $cooperatives = $query->get();

        // Generate PDF or Excel
        if ($format == 'pdf') {
            $pdf = Pdf::loadView('reports.generated', compact('cooperatives', 'reportType', 'region'));
            return $pdf->download('accredited_cooperatives_report.pdf');
        }

        if ($format == 'excel') {
            return Excel::download(new AccreditedCooperativesExport($cooperatives), 'accredited_cooperatives_report.xlsx');
        }
    }
    
}

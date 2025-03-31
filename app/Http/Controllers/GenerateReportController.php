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
        $format = $request->input('format');
        $filters = $request->all();

        // Fetch the data based on selected filters
        $query = GeneralInfo::query();

        if ($filters['status']) {
            $query->where('status', $filters['status']);
        }

        if ($filters['accreditation_date']) {
            $query->whereYear('accreditation_date', $filters['accreditation_date']);
        }

        $cooperatives = $query->get();

        // Generate PDF or Excel based on user selection
        if ($format == 'pdf') {
            $pdf = Pdf::loadView('reports.generated', compact('cooperatives', 'filters'));
            return $pdf->download('accredited_cooperatives_report.pdf');
        }

        if ($format == 'excel') {
            return Excel::download(new AccreditedCooperativesExport($cooperatives), 'accredited_cooperatives_report.xlsx');
        }
    }
}

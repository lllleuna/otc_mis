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
use Illuminate\Support\Facades\Http;


class GenerateReportController extends Controller
{
    public function index()
    {
        // Fetch all regions from API
        $regionsResponse = Http::get("https://psgc.gitlab.io/api/regions/");
        $regions = $regionsResponse->json();

        return view('reports.index', compact('regions'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'report_type' => 'required',
            'region' => 'nullable|string',
            'format' => 'required|in:pdf,excel',
        ]);

        $query = GeneralInfo::query();

        if ($request->region) {
            $query->where('region', $request->region);
        }

        $cooperatives = $query->get();

        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('reports.generated', compact('cooperatives'));
            return $pdf->download('accreditation_report.pdf');
        } elseif ($request->format === 'excel') {
            return Excel::download(new AccreditationReportExport($cooperatives), 'accreditation_report.xlsx');
        }

        return back()->withErrors(['Invalid format selected']);
    }

}

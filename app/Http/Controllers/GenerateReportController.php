<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\Application;
use App\Models\ReportHistory;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exports\GeneralInfoExport;
use App\Exports\AccreditedCooperativesExport;
use Illuminate\Support\Facades\Http;
use App\Exports\AccreditationReportExport;
use App\Exports\CGSRenewalReportExport;


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
            'report_type' => 'required|in:accreditation,cgs,acc_app,cgs_app',
            'status' => 'nullable|string',
            'region' => 'nullable|string',
            'year' => 'nullable|integer',
            'format' => 'required|in:pdf,excel',
        ]);
    
        $user = auth()->user();
    
        if ($request->report_type === 'accreditation') {
            // [Unchanged Accreditation Report Logic]
            $query = GeneralInfo::selectRaw("
                    cda_registration_no, 
                    MIN(accreditation_no) AS accreditation_no, 
                    MIN(name) AS name, 
                    MIN(region) AS region, 
                    MIN(city) AS city, 
                    MIN(status) AS status, 
                    MIN(accreditation_date) AS accreditation_date
                ")
                ->whereNotNull('accreditation_no')
                ->groupBy('cda_registration_no');
    
            if ($request->year) {
                $query->whereYear('accreditation_date', $request->year);
            }
    
            if ($request->region) {
                $query->where('region', $request->region);
            }
    
            $cooperatives = $query->get();
    
            if ($request->format === 'pdf') {
                $pdf = Pdf::loadView('reports.generated', compact('cooperatives', 'user'));
                return $pdf->download("{$request->report_type}_report.pdf");
            } elseif ($request->format === 'excel') {
                return Excel::download(new AccreditationReportExport($cooperatives, $user), "{$request->report_type}_report.xlsx");
            }
        }
    
        elseif ($request->report_type === 'cgs') {
            // [Unchanged CGS Report Logic]
            $query = GeneralInfo::selectRaw("
                    cda_registration_no, 
                    MIN(name) AS name, 
                    MAX(validity_date) AS validity_date,
                    (
                        SELECT accreditation_no FROM general_info gi2 
                        WHERE gi2.cda_registration_no = general_info.cda_registration_no 
                        AND gi2.accreditation_no IS NOT NULL
                        ORDER BY gi2.accreditation_date DESC 
                        LIMIT 1
                    ) AS accreditation_no,
                    MAX(CASE WHEN accreditation_no IS NOT NULL THEN region ELSE NULL END) AS region
                ")
                ->whereNotNull('validity_date')
                ->groupBy('cda_registration_no');
    
            if ($request->year) {
                $query->whereYear('validity_date', $request->year);
            }
    
            if ($request->region) {
                $query->where('region', $request->region);
            }
    
            $cooperatives = $query->get();
    
            if ($request->format === 'pdf') {
                $pdf = Pdf::loadView('reports.generated_cgs', compact('cooperatives', 'user'));
                return $pdf->download("{$request->report_type}_report.pdf");
            } elseif ($request->format === 'excel') {
                return Excel::download(new CGSRenewalReportExport($cooperatives, $user), "{$request->report_type}_report.xlsx");
            }
        }
    
        elseif (in_array($request->report_type, ['acc_app', 'cgs_app'])) {
            $query = Application::select('tc_name', 'cda_reg_no', 'cda_reg_date', 'region', 'status', 'created_at');
    
            if ($request->status) {
                $query->where('status', $request->status);
            }
    
            if ($request->region) {
                $query->where('region', $request->region);
            }
    
            if ($request->year) {
                $query->whereYear('updated_at', $request->year);
            }
    
            $cooperatives = $query->get();
    
            // Use new views and export classes
            if ($request->format === 'pdf') {
                $pdf = Pdf::loadView('reports.generated_application', compact('cooperatives', 'user'));
                return $pdf->download("{$request->report_type}_report.pdf");
            } elseif ($request->format === 'excel') {
                return Excel::download(new ApplicationReportExport($cooperatives, $user), "{$request->report_type}_report.xlsx");
            }
        }
    
        return back()->withErrors(['Invalid format selected']);
    }    

}

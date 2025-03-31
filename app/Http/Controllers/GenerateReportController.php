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
            'report_type' => 'required|in:accreditation,cgs',
            'region' => 'nullable|string',
            'year' => 'nullable|integer',
            'format' => 'required|in:pdf,excel',
        ]);
    
        if ($request->report_type === 'accreditation') {
            // Accreditation Report Query
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
            
            // Apply Year Filter
            if ($request->year) {
                $query->whereYear('accreditation_date', $request->year);
            }
    
        } elseif ($request->report_type === 'cgs') {
            // CGS Renewal Report Query
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
                    MIN(region) AS region
                ")
                ->whereNotNull('validity_date')
                ->groupBy('cda_registration_no');
            
            // Apply Year Filter
            if ($request->year) {
                $query->whereYear('validity_date', $request->year);
            }
        }
    
        // Apply Region Filter
        if ($request->region) {
            $query->where('region', $request->region);
        }
    
        $cooperatives = $query->get();
    
        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView(
                $request->report_type === 'accreditation' ? 'reports.generated' : 'reports.generated_cgs',
                compact('cooperatives')
            );
            return $pdf->download("{$request->report_type}_report.pdf");
        } elseif ($request->format === 'excel') {
            $exportClass = $request->report_type === 'accreditation' 
                ? new AccreditationReportExport($cooperatives) 
                : new CGSRenewalReportExport($cooperatives);
            
            return Excel::download($exportClass, "{$request->report_type}_report.xlsx");
        }
    
        return back()->withErrors(['Invalid format selected']);
    }
     
    

}

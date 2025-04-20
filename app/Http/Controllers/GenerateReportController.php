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
use App\Exports\ApplicationReportExport;


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
            
            // Filter by application_type based on report_type
            if ($request->report_type === 'acc_app') {
                $query->where('application_type', 'accreditation');
            } elseif ($request->report_type === 'cgs_app') {
                $query->where('application_type', 'CGS Renewal');
            }
            
            // Optional filters
            if ($request->status) {
                $query->where('status', $request->status);
            }
        
            if ($request->region) {
                // If region is selected, convert name to code
                $regionNames = [
                    '010000000' => 'Ilocos Region',
                    '020000000' => 'Cagayan Valley',
                    '030000000' => 'Central Luzon',
                    '040000000' => 'CALABARZON',
                    '170000000' => 'MIMAROPA Region',
                    '050000000' => 'Bicol Region',
                    '060000000' => 'Western Visayas',
                    '070000000' => 'Central Visayas',
                    '080000000' => 'Eastern Visayas',
                    '090000000' => 'Zamboanga Peninsula',
                    '100000000' => 'Northern Mindanao',
                    '110000000' => 'Davao Region',
                    '120000000' => 'SOCCSKSARGEN',
                    '130000000' => 'Caraga',
                    'CAR' => 'CAR',
                    'NCR' => 'NCR',
                    'BARMM' => 'BARMM',
                ];
        
                // Convert region name to code
                $regionCode = array_search($request->region, $regionNames);
        
                if ($regionCode) {
                    $query->where('region', $regionCode);
                }
            }
        
            if ($request->year) {
                $query->whereYear('updated_at', $request->year);
            }
        
            // Get the cooperatives matching the initial filters
            $cooperatives = $query->get();
        
            // If the report_type is 'cgs_app', filter rows with the same cda_reg_no and region not null
            if ($request->report_type === 'cgs_app') {
                // Get the cda_reg_no from the first matching row
                $cdaRegNo = $cooperatives->first()->cda_reg_no ?? null;
        
                if ($cdaRegNo) {
                    // Filter the query to find rows with the same cda_reg_no and where region is not null
                    $filteredCooperatives = Application::where('cda_reg_no', $cdaRegNo)
                        ->whereNotNull('region')
                        ->get();
                }
            }
        
            // Use new views and export classes
            if ($request->format === 'pdf') {
                $pdf = Pdf::loadView('reports.generated_application', compact('filteredCooperatives', 'user'));
                return $pdf->download("{$request->report_type}_report.pdf");
            } elseif ($request->format === 'excel') {
                return Excel::download(new ApplicationReportExport($filteredCooperatives, $user), "{$request->report_type}_report.xlsx");
            }
        }        
    
        return back()->withErrors(['Invalid format selected']);
    }    

}

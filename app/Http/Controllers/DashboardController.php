<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\Application;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('auth.login');
        }
    
        if (!$user->password_changed) {
            return view('auth.update-password');
        }
    
        if ($user->role === 'Admin') {
    
            // Count the rows in the GeneralInfo model with accreditation_no not null
            $generalInfoCount = GeneralInfo::whereNotNull('accreditation_no')->count();
    
            // Count the rows in the Application model where status is not 'rejected' or 'released'
            $applicationCount = Application::whereNotIn('status', ['rejected', 'released'])->count();
    
            // Pass the counts to the dashboard view
            return view('dashboard', [
                'generalInfoCount' => $generalInfoCount,
                'applicationCount' => $applicationCount
            ]);
        } else {
            return redirect()->route('general-info.index');
        }
    }
    
    
    public function getChartData(Request $request)
    {
        $year = $request->year ?? date('Y');

        // Cooperatives per Region
        $regionsData = GeneralInfo::whereNotNull('accreditation_no')
            ->groupBy('region')
            ->selectRaw('region, COUNT(*) as total')
            ->get();

        // CGS Renewals per Year (since 2020)
        $cgsData = GeneralInfo::whereYear('validity_date', '>=', 2020)
            ->selectRaw('YEAR(validity_date) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        // Accreditation Status per Year
        $accreditationData = Application::where('application_type', 'accreditation')
            ->whereYear('created_at', $year)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        // CGS Renewal Status per Year
        $renewalData = Application::where('application_type', 'CGS Renewal')
            ->whereYear('created_at', $year)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        return response()->json([
            'regions' => $regionsData,
            'cgs' => $cgsData,
            'accreditation' => $accreditationData,
            'renewal' => $renewalData,
        ]);
    }
}
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
            return redirect()->route('auth.login'); // Redirect to login if not authenticated
        }

        if (!$user->password_changed) {
            return view('auth.update-password'); // Redirect to password change page
        }

        // Check role
        if ($user->role === 'Admin') {
            return view('dashboard'); // Admins go to login view (as per your requirement)
        } else {
            return redirect()->route('general-info.index'); // Non-admin users go to tc.index view
        }
    }
    
    public function getChartData(Request $request)
    {
        $year = $request->year ?? date('Y');

        // Cooperatives per Region
        $regionsData = GeneralInfo::select('region')
            ->distinct('cda_registration_no')
            ->groupBy('region')
            ->selectRaw('region, COUNT(DISTINCT cda_registration_no) as total')
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
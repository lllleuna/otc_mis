<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;

class GeneralInfoController extends Controller
{
    public function index()
    {
        // Get the latest records grouped by accreditation_no
        $generalInfos = GeneralInfo::select('accreditation_no', 'accreditation_date', 'region', 'city', 'email', 'contact_no')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                      ->from('general_info')
                      ->groupBy('accreditation_no');
            })
            ->orderBy('accreditation_date', 'desc')
            ->get();

        return view('client.index', compact('generalInfos'));
    }

    public function show($accreditation_no)
    {
        $info = GeneralInfo::where('accreditation_no', $accreditation_no)
            ->latest('accreditation_date')
            ->first();

        if (!$info) {
            abort(404, 'Record not found');
        }

        return view('client.show', compact('info'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use Illuminate\Support\Facades\Http;

class GeneralInfoController extends Controller
{
    public function index()
    {
        // Fetch only records where accreditation_no is NOT NULL
        $generalInfos = GeneralInfo::whereNotNull('accreditation_no')->get();
    
        // Fetch all regions from API
        $regionsResponse = Http::get("https://psgc.gitlab.io/api/regions/");
        $regions = $regionsResponse->json();
    
        // Convert region codes to names
        foreach ($generalInfos as $info) {
            $regionNameResponse = Http::get("https://psgc.gitlab.io/api/regions/{$info->region}");
            $info->region_name = $regionNameResponse->json()['name'] ?? 'Unknown Region';
    
            $cityNameResponse = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$info->city}");
            $info->city_name = $cityNameResponse->json()['name'] ?? 'Unknown City';
        }
    
        return view('client.index', compact('generalInfos', 'regions'));
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

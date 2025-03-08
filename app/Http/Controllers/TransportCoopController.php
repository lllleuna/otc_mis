<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\Membership;
use App\Models\Employment;
use App\Models\Unit;
use App\Models\Franchise;
use App\Models\Cgs;
use App\Models\Governance;
use App\Models\Finance;
use App\Models\GrantsDonation;
use App\Models\Scholarship;
use App\Models\Loan;
use App\Models\Business;
use App\Models\Cetos;
use App\Models\TrainingSeminar;

class TransportCoopController extends Controller
{
    /**
     * Display a list of transport cooperatives.
     */
    public function index()
    {
        $coops = GeneralInfo::latest()->paginate(10);
        return view('tc.index', compact('coops'));
    }

    /**
     * Show details of a specific transport cooperative.
     */
    public function show($accreditation_no)
    {
        $data = $this->fetchCooperativeData($accreditation_no);
        return view('tc.show', $data);
    }

    /**
     * Show edit form for a transport cooperative.
     */
    public function edit($accreditation_no)
    {
        $data = $this->fetchCooperativeData($accreditation_no);
        return view('tc.edit', $data);
    }

    /**
     * Fetch all necessary data for a transport cooperative.
     */
    private function fetchCooperativeData($accreditation_no)
    {
        $generalinfo = GeneralInfo::where('accreditation_no', $accreditation_no)->firstOrFail();

        $relatedModels = [
            'membership' => Membership::class,
            'unit' => Unit::class,
            'employment' => Employment::class,
            'franchise' => Franchise::class,
            'cgs' => Cgs::class,
            'governance' => Governance::class,
            'finance' => Finance::class,
            'grantsDonation' => GrantsDonation::class,
            'scholarship' => Scholarship::class,
            'loan' => Loan::class,
            'business' => Business::class,
            'cetos' => Cetos::class,
            'trainingSeminar' => TrainingSeminar::class,
        ];

        $data = ['generalinfo' => $generalinfo, 'unit' => Unit::where('accreditation_no', $accreditation_no)->get()];

        foreach ($relatedModels as $key => $model) {
            $data[$key] = $model::where('accreditation_no', $accreditation_no)->latest('entry_year')->first();
        }

        // Fetch unique entry years
        $data['entryYears'] = Unit::where('accreditation_no', $accreditation_no)
            ->distinct()
            ->pluck('entry_year')
            ->sort();

        return $data;
    }

    /**
     * Show transportation cooperative details.
     */
    public function showTransportation($id)
    {
        return view('tc.show');
    }

}

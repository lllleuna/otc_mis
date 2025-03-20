<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Application;
use App\Models\User;
use App\Models\ApplicationStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AppGeneralInfo;
use App\Models\AppAward;
use App\Models\AppBusiness;
use App\Models\AppCetos;
use App\Models\AppFinance;
use App\Models\AppFranchise;
use App\Models\AppGovernance;
use App\Models\AppGrant;
use App\Models\AppLoan;
use App\Models\AppUnit;
use App\Models\GeneralInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ExternalUser;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'new');
        $search = $request->query('search'); 
        $userId = auth()->id();
    
        $applications = Application::query()
            ->when($search, fn($query) => 
                $query->where('reference_number', 'LIKE', "%$search%")
            )
            ->when(!$search, function ($query) use ($status, $userId) {
                // Always filter by status first
                $query->where('status', $status);
    
                // Apply user filter only if NOT new
                if ($status !== 'new') {
                    $query->where(function ($query) use ($userId) {
                        $query->where('evaluated_by', $userId)
                              ->orWhere('approved_by', $userId);
                    });
                }
            })
            ->paginate(10)
            ->appends(['search' => $search, 'status' => $status]); 
    
        return view('accreditation.officer.index', compact('applications', 'status', 'search'));
    }
    
    public function showApproval(Request $request)
    {
        $status = $request->query('status', 'evaluated');
        $search = $request->query('search'); 

        $applications = Application::when($search, function ($query, $search) {
                return $query->where('reference_number', 'LIKE', "%$search%");
            })
            ->when(!$search, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->paginate(10)
            ->appends(['search' => $search, 'status' => $status]); 

        return view('accreditation.head.index', compact('applications', 'status', 'search'));
    }


    public function evaluate($id)
    {
        $application = Application::findOrFail($id);

        $latestEvaluation = ApplicationStatusHistory::where('application_id', $id)
            ->latest()
            ->first();

        $appGenInfo = AppGeneralInfo::where('application_id', $id)
            ->latest()
            ->first();

        $appUnits = AppUnit::where('application_id', $id)->get();
        $appFranchises = AppFranchise::where('application_id', $id)->get();
        $appLoans = AppLoan::where('application_id', $id)->get();
        $appGov = AppGovernance::where('application_id', $id)->get();

        $appFinance = AppFinance::where('application_id', $id)
            ->latest()
            ->first();

        $appCetos = AppCetos::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.officer.evaluate', compact('appGov', 'appCetos', 'appLoans', 'appFinance','application', 'latestEvaluation', 'appGenInfo', 'appUnits', 'appFranchises'));
    
    }

    public function storeEvaluation(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $userId = Auth::id(); 

        $status = $request->input('action') === 'submit' ? 'evaluated' : 'saved';

        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status' => $status,
            'message' => $request->input('evaluation_notes'),
            'updated_by' => $userId
        ]);

        $application->update([
            'status' => $status,
            'evaluated_by' => $userId 
        ]);

        return redirect()->route('accreditation.evaluate.index')
            ->with('success', 'Evaluation updated successfully!');
    }

    public function approval($id)
    {
        $application = Application::findOrFail($id);

        $evaluation = ApplicationStatusHistory::where('application_id', $id)
            ->latest('updated_at')
            ->with('updatedBy') 
            ->first();

            $appGenInfo = AppGeneralInfo::where('application_id', $id)
            ->latest()
            ->first();

        $appUnits = AppUnit::where('application_id', $id)->get();
        $appFranchises = AppFranchise::where('application_id', $id)->get();
        $appLoans = AppLoan::where('application_id', $id)->get();
        $appGov = AppGovernance::where('application_id', $id)->get();

        $appFinance = AppFinance::where('application_id', $id)
            ->latest()
            ->first();

        $appCetos = AppCetos::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.head.approval', compact('application', 'evaluation', 'appGov', 'appCetos', 'appLoans', 'appFinance', 'appGenInfo', 'appUnits', 'appFranchises'));
    }

    public function storeApproval(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,needs_info',
            'message' => 'required|string|max:1000',
        ]);

        $application = Application::findOrFail($id);
        $userId = auth()->id(); 

        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status' => $request->status,
            'message' => $request->message,
            'updated_by' => $userId,
        ]);

        $appgeninfo = AppGeneralInfo::where('application_id', $id)->first();

        GeneralInfo::create([
            'name' => $appgeninfo->name,
            'accreditation_date' => now(),
            'cda_registration_no' => $appgeninfo->cda_registration_no,
            'cda_registration_date' => $appgeninfo->cda_registration_date,
            'common_bond_membership' => $appgeninfo->common_bond_membership,
            'membership_fee' => $appgeninfo->membership_fee,
            'area' => $appgeninfo->area,
            'region' => $appgeninfo->region,
            'city' => $appgeninfo->city,
            'province' => $appgeninfo->province,
            'barangay' => $appgeninfo->barangay,
            'business_address' => $appgeninfo->business_address,
            'email' => $appgeninfo->email,
            'contact_no' => $appgeninfo->contact_no,
            'contact_firstname' => "test",
            'contact_lastname' => "test",
            'contact_mid_initial' => "test",
            'contact_suffix' => "test",
            'employer_sss_reg_no' => $appgeninfo->employer_sss_reg_no,
            'employer_pagibig_reg_no' => $appgeninfo->employer_pagibig_reg_no,
            'employer_philhealth_reg_no' => $appgeninfo->employer_philhealth_reg_no,
            'bir_tin' => $appgeninfo->bir_tin,
            'bir_tax_exemption_no' => $appgeninfo->bir_tax_exemption_no,
        ]);

        $application->update([
            'status' => $request->status,
            'approved_by' => $userId 
        ]);

        return redirect()->route('accreditation.approval.index')
            ->with('success', 'Application status updated successfully.');
    }


    function generateUniqueAccreditationNumber()
    {
        $year = now()->format('Y');
        do {
            $randomNumber = random_int(100000, 999999); // Ensures always 6 digits
            $accreditationNumber = $year . '-' . $randomNumber;
            
            $exists = DB::table('general_info')->where('accreditation_no', $accreditationNumber)->exists();
        } while ($exists);

        return $accreditationNumber;
    }

    public function release($id)
    {
        $application = Application::findOrFail($id);

        $evaluation = ApplicationStatusHistory::where('application_id', $id)
            ->latest('updated_at')
            ->with('updatedBy') 
            ->first();

        $appGenInfo = AppGeneralInfo::where('application_id', $id)
            ->latest()
            ->first();

        $appUnits = AppUnit::where('application_id', $id)->get();
        $appFranchises = AppFranchise::where('application_id', $id)->get();
        $appLoans = AppLoan::where('application_id', $id)->get();
        $appGov = AppGovernance::where('application_id', $id)->get();

        $appFinance = AppFinance::where('application_id', $id)
            ->latest()
            ->first();

        $appCetos = AppCetos::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.officer.release', compact('application', 'evaluation', 'appGov', 'appCetos', 'appLoans', 'appFinance', 'appGenInfo', 'appUnits', 'appFranchises'));
    }

    public function storeRelease(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'validity_date' => 'required|date',
            'certificate_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // max 2MB
            'cgs_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // max 2MB
        ]);

        $application = Application::findOrFail($id);

        $certificateFile = $request->file('certificate_file');
        $cgsFile = $request->file('cgs_file');

        $dateString = now()->format('Ymd_His');
        $certificateFilename = 'accreditation_' . $dateString . '.' . $certificateFile->getClientOriginalExtension();
        $cgsFilename = 'cgs_' . $dateString . '.' . $cgsFile->getClientOriginalExtension();

        $certificatePath = $certificateFile->storeAs('certificates', $certificateFilename, 'public');
        $cgsPath = $cgsFile->storeAs('certificates', $cgsFilename, 'public');

        $accreditationNumber = $this->generateUniqueAccreditationNumber();

        $generalInfo = GeneralInfo::where('cda_registration_no', $application->cda_reg_no)->first();

        if ($generalInfo) {
            $generalInfo->accreditation_no = $accreditationNumber;
            $generalInfo->status = 'active';
            $generalInfo->validity_date = $request->validity_date;
            $generalInfo->accreditation_certificate_filename = $certificateFilename; // Store filename, not full path
            $generalInfo->cgs_filename = $cgsFilename;
            $generalInfo->save();
        }

        $application->status = 'released';
        $application->release_message = $request->message;
        $application->save();

        return redirect()->route('accreditation.evaluate.index')->with('success', 'Certificate Released Successfully!');
    }


}


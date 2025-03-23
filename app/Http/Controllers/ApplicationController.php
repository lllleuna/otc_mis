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
use App\Models\AppTrainingsList;

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
        $appGrants = AppGrant::where('application_id', $id)->get();
        $appAwards = AppAward::where('application_id', $id)->get();
        $appBusinesses = AppBusiness::where('application_id', $id)->get();
        $appTrainings = AppTrainingsList::where('application_id', $id)->get();

        $appFinance = AppFinance::where('application_id', $id)
            ->latest()
            ->first();

        $appCetos = AppCetos::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.officer.evaluate', compact('appTrainings', 'appBusinesses', 'appAwards', 'appGrants', 'appGov', 'appCetos', 'appLoans', 'appFinance','application', 'latestEvaluation', 'appGenInfo', 'appUnits', 'appFranchises'));
    
    }

    public function storeEvaluation(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $userId = Auth::id(); 
    
        $status = $request->input('action') === 'submit' ? 'evaluated' : 'saved';
    
        // Save Evaluation History
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status' => $status,
            'message' => $request->input('evaluation_notes'),
            'updated_by' => $userId
        ]);
    
        // Update application status
        $application->update([
            'status' => $status,
            'evaluated_by' => $userId,
        ]);
    
        // Find AppGeneralInfo record by application_id
        $generalInfo = AppGeneralInfo::where('application_id', $application->id)->first();
    
        if ($generalInfo) {
            $generalInfo->update([
                'cda_registration_no' => $request->input('cda_registration_no'),
                'cda_registration_date' => $request->input('cda_registration_date'),
                'common_bond_membership' => $request->input('common_bond_membership'),
                'membership_fee' => $request->input('membership_fee'),
                'email' => $request->input('email'),
                'contact_no' => $request->input('contact_no'),
                'business_address' => $request->input('business_address'),
                'barangay' => $request->input('barangay'),
                'city' => $request->input('city'),
                'province' => $request->input('province'),
                'region' => $request->input('region'),
                'area' => $request->input('area'),
                'employer_sss_reg_no' => $request->input('employer_sss_reg_no'),
                'employer_pagibig_reg_no' => $request->input('employer_pagibig_reg_no'),
                'employer_philhealth_reg_no' => $request->input('employer_philhealth_reg_no'),
                'bir_tin' => $request->input('bir_tin'),
                'bir_tax_exemption_no' => $request->input('bir_tax_exemption_no'),
                'validity' => $request->input('validity'),
            ]);
            
        }
    
        return redirect()->route('accreditation.evaluate.index', $application->id)
                         ->with('success', 'Evaluation saved successfully!');
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
        $appGrants = AppGrant::where('application_id', $id)->get();
        $appAwards = AppAward::where('application_id', $id)->get();
        $appBusinesses = AppBusiness::where('application_id', $id)->get();
        $appTrainings = AppTrainingsList::where('application_id', $id)->get();

        $appFinance = AppFinance::where('application_id', $id)
            ->latest()
            ->first();

        $appCetos = AppCetos::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.head.approval', compact('appTrainings', 'appBusinesses', 'appAwards', 'appGrants', 'application', 'evaluation', 'appGov', 'appCetos', 'appLoans', 'appFinance', 'appGenInfo', 'appUnits', 'appFranchises'));
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
            'name' => $appgeninfo->name ?? 'N/A',
            'accreditation_date' => now(),
            'cda_registration_no' => $appgeninfo->cda_registration_no ?? 'N/A',
            'cda_registration_date' => $appgeninfo->cda_registration_date ?? now(),
            'common_bond_membership' => $appgeninfo->common_bond_membership ?? 'N/A',
            'membership_fee' => $appgeninfo->membership_fee ?? 0,
            'area' => $appgeninfo->area ?? 'N/A',
            'region' => $appgeninfo->region ?? 'N/A',
            'city' => $appgeninfo->city ?? 'N/A',
            'province' => $appgeninfo->province ?? 'N/A',
            'barangay' => $appgeninfo->barangay ?? 'N/A',
            'business_address' => $appgeninfo->business_address ?? 'N/A',
            'email' => $appgeninfo->email ?? 'N/A',
            'contact_no' => $appgeninfo->contact_no ?? 'N/A',
            'contact_firstname' => "test",
            'contact_lastname' => "test",
            'contact_mid_initial' => "test",
            'contact_suffix' => "test",
            'employer_sss_reg_no' => $appgeninfo->employer_sss_reg_no ?? 'N/A',
            'employer_pagibig_reg_no' => $appgeninfo->employer_pagibig_reg_no ?? 'N/A',
            'employer_philhealth_reg_no' => $appgeninfo->employer_philhealth_reg_no ?? 'N/A',
            'bir_tin' => $appgeninfo->bir_tin ?? 'N/A',
            'bir_tax_exemption_no' => $appgeninfo->bir_tax_exemption_no ?? 'N/A',
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
        $appGrants = AppGrant::where('application_id', $id)->get();
        $appAwards = AppAward::where('application_id', $id)->get();
        $appBusinesses = AppBusiness::where('application_id', $id)->get();
        $appTrainings = AppTrainingsList::where('application_id', $id)->get();

        $appFinance = AppFinance::where('application_id', $id)
            ->latest()
            ->first();

        $appCetos = AppCetos::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.officer.release', compact('appTrainings', 'appBusinesses', 'appAwards', 'appGrants', 'application', 'evaluation', 'appGov', 'appCetos', 'appLoans', 'appFinance', 'appGenInfo', 'appUnits', 'appFranchises'));
    }

    public function storeRelease(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'validity_date' => 'required|date',
            'certificate_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'cgs_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
    
        $application = Application::findOrFail($id);
        $appGen = AppGeneralInfo::where('application_id', $id);

    
        // Handle file uploads
        $certificateFile = $request->file('certificate_file');
        $cgsFile = $request->file('cgs_file');
    
        $dateString = now()->format('Ymd_His');

        $certificateFilename = 'accreditation_' . $dateString . '.' . $certificateFile->getClientOriginalExtension();
        $cgsFilename = 'cgs_' . $dateString . '.' . $cgsFile->getClientOriginalExtension();

        // Store in the shared directory
        $certificateFile->move(public_path('shared/certificates'), $certificateFilename);
        $cgsFile->move(public_path('shared/certificates'), $cgsFilename);

        $accreditationNumber = $this->generateUniqueAccreditationNumber();
    
        // Insert new row to GeneralInfo (ALWAYS create new row)
        $generalInfo = new GeneralInfo();
        $generalInfo->application_id = $application->id;
        $generalInfo->name = $application->tc_name ?? 'N/A';
        $generalInfo->accreditation_date = now();
        $generalInfo->cda_registration_date = $application->cda_reg_date;

        $generalInfo->common_bond_membership = $appGen->common_bond_membership;
        $generalInfo->membership_fee = $appGen->membership_fee;
        $generalInfo->area = $appGen->area;
        $generalInfo->region = $appGen->region;
        $generalInfo->city = $appGen->city;
        $generalInfo->province = $appGen->province;
        $generalInfo->barangay = $appGen->barangay;
        $generalInfo->business_address = $application->business_address;
        $generalInfo->email = $appGen->email;
        $generalInfo->contact_no = $appGen->contact_no;
        $generalInfo->contact_firstname = $appGen->contact_firstname ?? 'N/A';
        $generalInfo->contact_lastname = $appGen->contact_lastname ?? 'N/A';
        $generalInfo->employer_sss_reg_no = $appGen->employer_sss_reg_no;
        $generalInfo->employer_pagibig_reg_no = $appGen->employer_pagibig_reg_no;
        $generalInfo->employer_philhealth_reg_no = $appGen->employer_philhealth_reg_no;
        $generalInfo->bir_tin = $appGen->bir_tin;
        $generalInfo->bir_tax_exemption_no = $appGen->bir_tax_exemption_no;

        $generalInfo->accreditation_no = $accreditationNumber;
        $generalInfo->status = 'active';
        $generalInfo->validity_date = $request->validity_date;
        $generalInfo->accreditation_certificate_filename = $certificateFilename;
        $generalInfo->cgs_filename = $cgsFilename;
        $generalInfo->save();
    
        // Update application status to 'released'
        $application->status = 'released';
        $application->release_message = $request->message;
        $application->save();
    
        // Add to status history
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status' => 'released',
            'message' => $request->message,
            'updated_by' => auth()->id(),
        ]);
    
        // Update external user status
        ExternalUser::where('id', $application->user_id)->update([
            'accreditation_status' => 'Active',
        ]);
    
        return redirect()->route('accreditation.evaluate.index')->with('success', 'Certificate Released Successfully!');
    }
    
    
    public function showHistory($id)
    {
        $application = Application::with(['statusHistories.updatedBy', 'generalInfo'])->findOrFail($id);
    
        return view('components.released', compact('application'));
    }
    

    
}


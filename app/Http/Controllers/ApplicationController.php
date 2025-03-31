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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusMail;
use App\Mail\EvaluationNotification;
use App\Mail\ApplicationApprovedMail;
use App\Mail\ApplicationRejectedMail;

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


    public function evaluate(Request $request, $id)
    {
        $formData = $request->session()->get('form_data', []);
    
        $application = Application::findOrFail($id);
        $appGenInfo = AppGeneralInfo::where('application_id', $id)->latest()->first();
    
        // Get codes from database if not in session
        $regionCode = $formData['region'] ?? $appGenInfo->region ?? null;
        $cityCode = $formData['city'] ?? $appGenInfo->city ?? null;
        $barangayCode = $formData['barangay'] ?? $appGenInfo->barangay ?? null;
    
        // Default values
        $regionName = 'Unknown Region';
        $cityName = 'Unknown City/Municipality';
        $barangayName = 'Unknown Barangay';
    
        // Fetch Region Name from PSGC API
        if ($regionCode) {
            $regionResponse = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/");
            if ($regionResponse->successful()) {
                $regionName = $regionResponse->json()['name'];
            }
        }
    
        // Fetch City/Municipality Name from PSGC API
        if ($cityCode) {
            $cityResponse = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/");
            if ($cityResponse->successful()) {
                $cityName = $cityResponse->json()['name'];
            }
        }
    
        // Fetch Barangay Name from PSGC API
        if ($barangayCode) {
            $barangayResponse = Http::get("https://psgc.gitlab.io/api/barangays/{$barangayCode}/");
            if ($barangayResponse->successful()) {
                $barangayName = $barangayResponse->json()['name'];
            }
        }
    
        $latestEvaluation = ApplicationStatusHistory::where('application_id', $id)->latest()->first();
        $appUnits = AppUnit::where('application_id', $id)->get();
        $appFranchises = AppFranchise::where('application_id', $id)->get();
        $appLoans = AppLoan::where('application_id', $id)->get();
        $appGov = AppGovernance::where('application_id', $id)->get();
        $appGrants = AppGrant::where('application_id', $id)->get();
        $appAwards = AppAward::where('application_id', $id)->get();
        $appBusinesses = AppBusiness::where('application_id', $id)->get();
        $appTrainings = AppTrainingsList::where('application_id', $id)->get();
        $appFinance = AppFinance::where('application_id', $id)->latest()->first();
        $appCetos = AppCetos::where('application_id', $id)->latest()->first();
    
        return view('accreditation.officer.evaluate', array_merge(
            compact('appTrainings', 'appBusinesses', 'appAwards', 'appGrants', 'appGov', 'appCetos', 'appLoans', 'appFinance', 'application', 'latestEvaluation', 'appGenInfo', 'appUnits', 'appFranchises'),
            [
                'regionName' => $regionName,
                'cityName' => $cityName,
                'barangayName' => $barangayName,
            ]
        ));
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

        // Send Email Notification if status is evaluated
        if ($status === 'evaluated' && !empty($generalInfo->email)) {
            Mail::to($generalInfo->email)->send(new EvaluationNotification($application, $request->input('evaluation_notes')));
        }
    
        return redirect()->route('accreditation.evaluate.index', $application->id)
                         ->with('success', 'Evaluation saved successfully!');
    }
    
    public function approval(Request $request, $id)
    {
        $formData = $request->session()->get('form_data', []);
    
        $application = Application::findOrFail($id);
        $appGenInfo = AppGeneralInfo::where('application_id', $id)->latest()->first();
    
        // Get codes from database if not in session
        $regionCode = $formData['region'] ?? $appGenInfo->region ?? null;
        $cityCode = $formData['city'] ?? $appGenInfo->city ?? null;
        $barangayCode = $formData['barangay'] ?? $appGenInfo->barangay ?? null;
    
        // Default values
        $regionName = 'Unknown Region';
        $cityName = 'Unknown City/Municipality';
        $barangayName = 'Unknown Barangay';
    
        // Fetch Region Name from PSGC API
        if ($regionCode) {
            $regionResponse = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/");
            if ($regionResponse->successful()) {
                $regionName = $regionResponse->json()['name'];
            }
        }
    
        // Fetch City/Municipality Name from PSGC API
        if ($cityCode) {
            $cityResponse = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/");
            if ($cityResponse->successful()) {
                $cityName = $cityResponse->json()['name'];
            }
        }
    
        // Fetch Barangay Name from PSGC API
        if ($barangayCode) {
            $barangayResponse = Http::get("https://psgc.gitlab.io/api/barangays/{$barangayCode}/");
            if ($barangayResponse->successful()) {
                $barangayName = $barangayResponse->json()['name'];
            }
        }
    
        $application = Application::findOrFail($id);
    
        $evaluation = ApplicationStatusHistory::where('application_id', $id)
            ->latest('updated_at')
            ->with('updatedBy')
            ->first();
    
        $appGenInfo = AppGeneralInfo::where('application_id', $id)->latest()->first();
        $appUnits = AppUnit::where('application_id', $id)->get();
        $appFranchises = AppFranchise::where('application_id', $id)->get();
        $appLoans = AppLoan::where('application_id', $id)->get();
        $appGov = AppGovernance::where('application_id', $id)->get();
        $appGrants = AppGrant::where('application_id', $id)->get();
        $appAwards = AppAward::where('application_id', $id)->get();
        $appBusinesses = AppBusiness::where('application_id', $id)->get();
        $appTrainings = AppTrainingsList::where('application_id', $id)->get();
        $appFinance = AppFinance::where('application_id', $id)->latest()->first();
        $appCetos = AppCetos::where('application_id', $id)->latest()->first();
    
        return view('accreditation.head.approval', array_merge(
            compact('appTrainings', 'appBusinesses', 'appAwards', 'appGrants', 'application', 'evaluation', 'appGov', 'appCetos', 'appLoans', 'appFinance',  'appGenInfo', 'appUnits', 'appFranchises'),
            [
                'regionName' => $regionName,
                'cityName' => $cityName,
                'barangayName' => $barangayName,
            ]
        ));
    }
    

    public function storeApproval(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,needs_info',
            'message' => 'required|string|max:1000',
        ]);
    
        $application = Application::findOrFail($id);
        $userId = auth()->id(); 
        $user = $application->user;
    
        // Store status history
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status' => $request->status,
            'message' => $request->message,
            'updated_by' => $userId,
        ]);
    
        $appgeninfo = AppGeneralInfo::where('application_id', $id)->first();
    
        if ($request->status === 'approved') {
    
            // Send Approval Email
            Mail::to($appgeninfo->email)->send(new ApplicationApprovedMail($application));
        }
    
        // If rejected, send a rejection email
        if ($request->status === 'rejected') {
            Mail::to($appgeninfo->email)->send(new ApplicationRejectedMail($application, $request->message));
        }
    
        // Update application status
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
        $application = Application::findOrFail($id);
        $appGen = AppGeneralInfo::where('application_id', $id)->first();
        $generalInfo = GeneralInfo::where('application_id', $id)->first();
    
        // Validation rules based on application type
        $request->validate([
            'message' => 'required|string|max:1000',
            'validity_date' => 'required|date',
            'accreditation_certificate_filename' => $application->application_type === 'CGS Renewal' 
                ? 'nullable' 
                : 'required|mimes:pdf,jpg,jpeg,png|max:5048',
            'cgs_file' => 'required|mimes:pdf,jpg,jpeg,png|max:5048',
        ]);
    
        // Handle file uploads
        $dateString = now()->format('Ymd_His');
        
        // Save CGS File
        $cgsFile = $request->file('cgs_file');
        $cgsFilename = 'cgs_' . $dateString . '.' . $cgsFile->getClientOriginalExtension();
        $cgsFile->move(public_path('shared/certificates'), $cgsFilename);
    
        // Save Accreditation Certificate (if applicable)
        $certificateFilename = null;
        if ($application->application_type === 'accreditation' && $request->hasFile('accreditation_certificate_filename')) {
            $certificateFile = $request->file('accreditation_certificate_filename');
            $certificateFilename = 'accreditation_' . $dateString . '.' . $certificateFile->getClientOriginalExtension();
            $certificateFile->move(public_path('shared/certificates'), $certificateFilename);
        }
    
        // If CGS Renewal, update existing record; if Accreditation, create if not exists
        if (!$generalInfo) {
            $generalInfo = new GeneralInfo();
            $generalInfo->application_id = $application->id;
    
            // Only generate accreditation number for accreditation applications
            if ($application->application_type === 'accreditation') {
                $generalInfo->accreditation_no = $this->generateUniqueAccreditationNumber();
            }
        }
    
        // Update GeneralInfo fields
        $generalInfo->name = $application->tc_name ?? 'N/A';
        $generalInfo->accreditation_date = now();
        $generalInfo->cda_registration_date = $application->cda_reg_date ?? 'N/A';
        $generalInfo->cda_registration_no = $application->cda_reg_no ?? 'N/A';
        $generalInfo->common_bond_membership = $appGen->common_bond_membership ?? 'N/A';
        $generalInfo->membership_fee = $appGen->membership_fee ?? 0.00;
        $generalInfo->area = $appGen->area ?? 'N/A';
        $generalInfo->region = $application->region ?? 'N/A';
        $generalInfo->city = $application->city ?? 'N/A';
        $generalInfo->province = $appGen->province ?? 'N/A';
        $generalInfo->barangay = $application->barangay ?? 'N/A';
        $generalInfo->business_address = $application->business_address ?? 'N/A';
        $generalInfo->email = $appGen->email ?? 'N/A';
        $generalInfo->contact_no = $appGen->contact_no ?? 'N/A';
        $generalInfo->contact_firstname = $appGen->contact_firstname ?? 'N/A';
        $generalInfo->contact_lastname = $appGen->contact_lastname ?? 'N/A';
        $generalInfo->employer_sss_reg_no = $appGen->employer_sss_reg_no ?? 'N/A';
        $generalInfo->employer_pagibig_reg_no = $appGen->employer_pagibig_reg_no ?? 'N/A';
        $generalInfo->employer_philhealth_reg_no = $appGen->employer_philhealth_reg_no ?? 'N/A';
        $generalInfo->bir_tin = $appGen->bir_tin ?? 'N/A';
        $generalInfo->bir_tax_exemption_no = $appGen->bir_tax_exemption_no ?? 'N/A';
        $generalInfo->status = 'active';
        $generalInfo->validity_date = $request->validity_date;
        $generalInfo->cgs_filename = $cgsFilename;
    
        // Store accreditation certificate only if it's an accreditation
        if ($application->application_type === 'accreditation') {
            $generalInfo->accreditation_certificate_filename = $certificateFilename;
        }
    
        $generalInfo->save();
    
        // Update application status to 'released'
        $application->status = 'released';
        $application->release_message = $request->message;
        $application->save();

        // Update external user status
        ExternalUser::where('id', $application->user_id)->update([
            'accreditation_status' => 'Active',
        ]);
    
        return redirect()->route('accreditation.evaluate.index')->with('success', 'Certificate Released Successfully.');
    }
    
    
    
    public function showHistory($id)
    {
        $application = Application::with(['statusHistories.updatedBy', 'generalInfo'])->findOrFail($id);
    
        return view('components.released', compact('application'));
    }
    

    
}


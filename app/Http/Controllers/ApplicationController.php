<?php

namespace App\Http\Controllers;


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

        return view('accreditation.officer.evaluate', compact('application', 'latestEvaluation'));
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

        return view('accreditation.head.approval', compact('application', 'evaluation'));
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

        $application->update([
            'status' => $request->status,
            'approved_by' => $userId 
        ]);

        return redirect()->route('accreditation.approval.index')
            ->with('success', 'Application status updated successfully.');
    }

}


<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // To get the logged-in user

class ApplicationController extends Controller
{
    public function index(Request $request)
{
    $status = $request->query('status', 'new'); // Default status filter
    $search = $request->query('search'); // Get search input

    $applications = Application::when($search, function ($query, $search) {
            return $query->where('reference_number', 'LIKE', "%$search%");
        })
        ->when(!$search, function ($query) use ($status) {
            return $query->where('status', $status);
        })
        ->paginate(10) // Paginate results
        ->appends(['search' => $search, 'status' => $status]); // Append query parameters for persistence

    return view('accreditation.officer.index', compact('applications', 'status', 'search'));
}


    public function evaluate($id)
    {
        $application = Application::findOrFail($id);

        // Get the latest evaluation record for this application
        $latestEvaluation = ApplicationStatusHistory::where('application_id', $id)
            ->latest()
            ->first();

        return view('accreditation.officer.evaluate', compact('application', 'latestEvaluation'));
    }

    public function storeEvaluation(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $userId = Auth::id(); // Get logged-in user ID

        $status = $request->input('action') === 'submit' ? 'waiting' : 'evaluated';

        // Store evaluation details in application_status_histories
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status' => $status,
            'message' => $request->input('evaluation_notes'),
            'updated_by' => $userId
        ]);

        // Update application's current status
        $application->update(['status' => $status]);

        return redirect()->route('accreditation.index')
            ->with('success', 'Evaluation updated successfully!');

    }
}

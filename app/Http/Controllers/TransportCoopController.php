<?php

namespace App\Http\Controllers;

use App\Models\Coop;
use Illuminate\Http\Request;

class TransportCoopController extends Controller
{
    public function index()
    {
        $coops = Coop::orderBy('created_at', 'desc')->paginate(10);
        return view('tc.index', compact('coops'));
    }

    public function show($id)
    {
        // Fetch the transportation cooperative details using the ID
        $coop = Coop::findOrFail($id);
        return view('tc.show', compact('coop'));
    }

    public function showTransportation($id)
    {
        // Logic to fetch transportation cooperative details
        return view('tc.show');
    }

    public function submitRecord(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'trxRef' => 'required|unique:records',
            'transactionType' => 'required',
            'applicant' => 'required',
            'cooperative' => 'required',
            'dateReceived' => 'required|date',
            // Other validations
        ]);
        // Save record logic

        return redirect()->route('dashboard')->with('success', 'Record created successfully!');
    }

    public function approveRecord(Request $request)
    {
        // Logic to approve a record

        return redirect()->route('dashboard')->with('success', 'Record approved successfully!');
    }
}

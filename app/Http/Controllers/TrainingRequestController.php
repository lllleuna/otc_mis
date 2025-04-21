<?php

namespace App\Http\Controllers;

use App\Models\TrainingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TrainingRequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = TrainingRequest::query()
            ->when($request->filled('cda_reg_no'), fn($q) => $q->where('cda_reg_no', 'like', '%' . $request->cda_reg_no . '%'))
            ->when($request->filled('training_type'), fn($q) => $q->where('training_type', $request->training_type))
            ->when($request->filled('reference_no'), fn($q) => $q->where('reference_no', 'like', '%' . $request->reference_no . '%'))
            ->latest()
            ->paginate(10);    
                        
        return view('training_requests.index', compact('requests'));
    }    

    public function show($id)
    {
        $request = TrainingRequest::findOrFail($id);
        return view('training_requests.show', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'training_type' => 'required',
            'training_date_time' => 'required|date',
            'status' => 'required',
            'meeting_link' => 'nullable|url',
        ]);

        $training = TrainingRequest::findOrFail($id);
        $training->update($data);

        // Send email
        Mail::send('emails.training_status', ['training' => $training], function ($m) use ($training) {
            $m->to($training->email)
              ->subject('Training Request Update');
        });

        return redirect()->route('training.index')->with('success', 'Training request updated and email sent.');
    }
}
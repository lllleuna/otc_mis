<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\Evaluation;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::where('status', 'on-process')
                                ->orderBy('created_at', 'desc')
                                ->get();

    return view('application.index', compact('applications'));
    }

    public function approved()
    {
        $applications = Application::where('status', 'evaluated')
                                ->orderBy('created_at', 'desc')
                                ->get();

    return view('application.approved', compact('applications'));
    }

    public function show(Application $application) {
        return view('application.show', ['application' => $application]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'application_id' => ['required'],
            'eval_remarks' => ['required'],
        ]);

        $attributes['evaluator_id'] = auth()->id();

        Evaluation::create($attributes);

        Application::where('id', $attributes['application_id'])->update(['status' => 'evaluated']);

        return redirect('/application');
    }
}

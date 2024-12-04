<?php

namespace App\Http\Controllers;
use App\Models\Application;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index() 
    {
        $applications = Application::orderBy('created_at', 'desc')->paginate(10);
        return view('application.index',compact('applications'));
    }
}

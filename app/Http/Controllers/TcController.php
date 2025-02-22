<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TcController extends Controller
{
    public function showEvaluation()
    {
        return view('tc.evaluation');
    }
}

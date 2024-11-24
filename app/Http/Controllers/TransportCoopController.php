<?php

namespace App\Http\Controllers;
use App\Models\Coop;

use Illuminate\Http\Request;

class TransportCoopController extends Controller
{
    public function index() 
    {
        $coops = Coop::orderBy('created_at', 'desc')->paginate(10);
        return view('tc.index',compact('coops'));
    }
}

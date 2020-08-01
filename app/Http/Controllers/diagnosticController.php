<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device; 

class diagnosticController extends Controller
{
    //
    public function index()
    {
        //
        // return view('diagnostics');
        $devices = device::all();
        // return device::all();
        return view('diagnostics')->with('devices', $devices);
    }

}

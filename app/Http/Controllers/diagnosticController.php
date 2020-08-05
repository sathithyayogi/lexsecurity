<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class diagnosticController extends Controller
{
    //
    public function index()
    {
        $devices = device::all();
        return view('diagnostics')->with('devices', $devices);
    }

}

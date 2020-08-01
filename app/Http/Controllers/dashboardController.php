<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device; 

class dashboardController extends Controller
{
    //
    public function index()
    {
        $devices = device::all();
        return view('dashboard')->with('devices', $devices);
    }
}

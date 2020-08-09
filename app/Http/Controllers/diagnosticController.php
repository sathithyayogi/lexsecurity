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

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $device = device::findorFail($id);
        // return $devices;
        return view('show')->with('device', $device);
    }


}

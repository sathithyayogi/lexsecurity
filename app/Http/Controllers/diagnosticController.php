<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Events\WebsocketDemoEvent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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

        broadcast(new WebsocketDemoEvent('some data'));
        $device = device::findorFail($id);
        // return $devices;
        return view('show')->with('device', $device);
    }


}
